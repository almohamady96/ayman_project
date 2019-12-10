<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notification;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class UsersController extends Controller
{
    //
    /*
===================================================
         Dashboard operations of users
===================================================
*/

    public function checkUserActive()
    {
        $user = Auth::user();
        if ($user->isActive == 1) {
            //return 'active';
            if (Auth::user()->hasRole(1) || Auth::user()->hasRole(2)) {
                return redirect()->intended('/AdminPanel');
            } else {
                return redirect()->intended('/');
            }
        } else {
            session()->flash('Faild', 'عفواً لقد تم إيقاف العضويه الخاصه بك');
            auth()->logout();
            return redirect('/');
        }
    }

    public function getAllUsers()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('AdminPanel.Users.Users',
            [
                'PageTitle' => 'إدارة الأعضاء',
                'Active' => 'Users',
                'users' => $users,
            ]);
    }


    public function getSuperAdmins()
    {
        $users = User::orderBy('id', 'desc')->get();
        $role = 1;
        return view('AdminPanel.Users.SuperAdmins',
            [
                'PageTitle' => 'إدارة الأعضاء - أعضاء بصلاحيات مدير الموقع',
                'Active' => 'SuperAdmins',
                'users' => $users,
                'role' => $role,
            ]);
    }


    public function getAdmins()
    {
        $users = User::orderBy('id', 'desc')->get();
        $role = 2;
        return view('AdminPanel.Users.SuperAdmins',
            [
                'PageTitle' => 'إدارة الأعضاء - أعضاء بصلاحيات مشرف ',
                'Active' => 'Admins',
                'users' => $users,
                'role' => $role,
            ]);
    }


    public function getUsersOnly()
    {
        $users = User::orderBy('id', 'desc')->get();
        $role = 3;

        return view('AdminPanel.Users.SuperAdmins',
            [
                'PageTitle' => 'إدارة الأعضاء - أعضاء بدون صلاحيات',
                'Active' => 'NoPermissions',
                'users' => $users,
                'role' => $role,
            ]);
    }


    public function getCreateUser()
    {
        $roles = Role::all();
        $select_role = [];
        foreach ($roles as $role) {
            $select_role[$role->id] = $role->name;
        }

        $categories=Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        $select_category = [];

        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $select_category[$cate->id] = $cate->name;
            } else {
                $select_category[$cate->id] = $cate->name . ' ( مؤرشف حالياً ) ';
            }
        }

        return view('AdminPanel.Users.CreateUser',
            [
                'PageTitle' => 'إدارة الأعضاء | عضو جديد',
                'Active' => 'Users',
                'select_role' => $select_role,
                'select_category' => $select_category,
            ]);
    }


    public function postCreateUser(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|string|min:2|max:60',
            'uniqueName' => 'alpha_dash|min:5|max:30|unique:users,uniqueName',
            'email' => 'required|email|max:255|unique:users,email',
            'mobile' => 'nullable|unique:users|numeric|regex:/[0-9]{10}/',
            'whatsApp' => 'nullable|unique:users|numeric|regex:/[0-9]{10}/',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required',
            'password' => 'required|alpha_dash|min:6|max:70',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = New User();
        $user->name = $request['userName'];
        $user->uniqueName = $request['uniqueName'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->whatsApp = $request['whatsApp'];
        $user->address = $request['address'];
        $user->password = bcrypt($request['password']);

        $categories=[];
        if($request['categories'] != ''){
            $categories = [];
            foreach ($request['categories'] as $category) {
                array_push($categories, $category);
            }
            $user->categories = base64_encode(serialize($categories));
        }else{
            $user->categories = '';
        }
        

        //get day, month and year for the session date

        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $user->day = $day;
        $user->month = $month;
        $user->year = $year;

        if ($user->save()) {
            foreach ($request['role_id'] as $role) {
                $user->roles()->attach($role);
            }
            session()->flash('Success', 'تم إضافه العضو بنجاح');
            return redirect('/AdminPanel/Users');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateUser($UID)
    {
        $user = User::find($UID);
        $roles = Role::all();
        $select_role = [];
        foreach ($roles as $role) {
            $select_role[$role->id] = $role->name;
        }

        $categories=Category::orderBy('number', 'asc')
                ->orderBy('id', 'desc')->get();
            $select_category = [];

            foreach ($categories as $cate) {
                if ($cate->status == 'published') {
                    $select_category[$cate->id] = $cate->name;
                } else {
                    $select_category[$cate->id] = $cate->name . ' ( مؤرشف حالياً ) ';
                }
            }

        return view('AdminPanel.Users.UpdateUser',
            [
                'PageTitle' => ' إدارة الأعضاء ',
                'Active' => 'Users',
                'user' => $user,
                'select_role' => $select_role,
               'select_category' => $select_category,
            ]);
    }


    public function postUpdateUser($UID, Request $request)
    {
        $user = User::find($UID);

        $this->validate($request, [
            'userName' => 'required|string|min:2|max:60',
            'uniqueName' => 'alpha_dash|min:5|max:30|unique:users,uniqueName,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|numeric|regex:/[0-9]{10}/|unique:users,mobile,' . $user->id,
            'whatsApp' => 'nullable|numeric|regex:/[0-9]{10}/|unique:users,whatsApp,' . $user->id,
            'address' => 'nullable|string|max:255',
            'role_id' => 'required',
            'isActive' => 'required',
            'password' => 'nullable|alpha_dash|min:6|max:70',
            'password_confirmation' => 'nullable|required_unless:password,!=,""|same:password',
        ],[
            'password_confirmation.required_unless'=>'من فضلك أدخل تأكيد كلمه المرور',
        ]);

        $user->name = $request['userName'];
        $user->uniqueName = $request['uniqueName'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->whatsApp = $request['whatsApp'];
        $user->address = $request['address'];
        $user->isActive = $request['isActive'];
        if ($request->password != '') {
            $user->password = bcrypt($request['password']);
        }

        if($request['categories'] != ''){
            $categories = [];
            foreach ($request['categories'] as $category) {
                array_push($categories, $category);
            }
            $user->categories = base64_encode(serialize($categories));
        }else{
            $user->categories = '';
        }

        if ($user->update()) {
            $user->roles()->detach();
            foreach ($request['role_id'] as $role) {
                $user->roles()->attach($role);
            }
            session()->flash('Success', 'تم تعديل بيانات العضويه بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function postChangeRoles($UID, Request $request)
    {
        $user = User::find($UID);
        $user->roles()->detach();
        $user->roles()->attach(Role::find($request['role_id']));
        if ($user->update()) {
            session()->flash('Success', 'تم تعديل الصلاحيات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteUser($UID)
    {
        $user = User::find($UID);

        $notifications = Notification::where('user_id', '=', $user->id)
            ->orWhere('receiver_id', '=', $user->id)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }

        if ($user->delete()) {
            return Response::json($UID);
        } else {
            return Response::json("false");
        }
    }


}
