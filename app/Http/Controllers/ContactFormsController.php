<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\NotificationEmail;
use App\Notification;
use App\Setting;
use App\User;
use App\UserRole;
use App\Applications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;

class ContactFormsController extends Controller
{
    //

    /*===========================================
                     Frontend
     =============================================*/


    public function postContactUsFooter(Request $request)
    {
        $this->validate($request, [
            'formUserName' => 'required|string|min:2|max:255',
            'formEmail' => 'required|email',
            'formMobile' => 'nullable|numeric|regex:/[0-9]{10}/',
            'messageContent' => 'required|min:2',

        ]);

        $contact = new Contact();
        $contact->name = $request['formUserName'];
        $contact->mobile = $request['formMobile'];
        $contact->email = $request['formEmail'];
        $contact->content = $request['messageContent'];

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");

        $contact->day = $day;
        $contact->month = $month;
        $contact->year = $year;


        if ($contact->save()) {
            $setting = Setting::get()->keyBy('key')->all();

            // send notification to admin
            $userAdmins=UserRole::where('role_id','=',1)->get()->pluck('user_id')->toArray();
            $admins=User::whereIn('id',$userAdmins)->get();

            if (count($admins) != 0) {
                $mail = 0;
                foreach ($admins as $admin) {
                    $notification = new Notification();
                    $notification->user_id = null;
                    $notification->receiver_id = $admin->id;
                    $notification->type = 'contact';
                    $notification->linked_id = $contact->id;
                    $notification->content =
                        ' قام '
                        . $contact->name
                        . ' بإرسال رساله جديده للإداره ';
                    $notification->sendto = 'admin';
                    $notification->save();
                    if ($setting['notification_status']->value == 'both'
                        && $setting['notification_email']->value != ''
                        && $mail == 0) {

                        Mail::to($setting['notification_email']->value)->send(new NotificationEmail($notification));
                        $mail = 1;
                    }
                }
            }
            session()->put('Success', trans('alert.messageSentOk'));
            return back();

        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function postContactUsPage(Request $request)
    {
        $this->validate($request, [
            'userName' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'mobile' => 'nullable|numeric|regex:/[0-9]{10}/',
            'contactContent' => 'required|min:2',

        ]);
        
        if($request['recaptcha'] != $request['T3']){
            session()->put('Faild', 'يرجى التحقق من نتيجة معادلة التحقق البشرى');
            return back()->withInput();
        }

        $contact = new Contact();
        $contact->name = $request['userName'];
        $contact->mobile = $request['mobile'];
        $contact->email = $request['email'];
        $contact->content = $request['contactContent'];

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");

        $contact->day = $day;
        $contact->month = $month;
        $contact->year = $year;


        if ($contact->save()) {
            $setting = Setting::get()->keyBy('key')->all();

            // send notification to admin
            $userAdmins = UserRole::where('role_id', '=', 1)->get()->pluck('user_id')->toArray();
            $admins = User::whereIn('id', $userAdmins)->get();
            if (count($admins) != 0) {
                $mail = 0;
                foreach ($admins as $admin) {
                    $notification = new Notification();
                    $notification->user_id = null;
                    $notification->receiver_id = $admin->id;
                    $notification->type = 'contact';
                    $notification->linked_id = $contact->id;
                    $notification->content =
                        ' قام '
                        . $contact->name
                        . ' بإرسال رساله جديده للإداره ';
                    $notification->sendto = 'admin';
                    $notification->save();
                    if ($setting['notification_status']->value == 'both'
                        && $setting['notification_email']->value != ''
                        && $mail == 0) {
                            
                        Mail::to($setting['notification_email']->value)->send(new NotificationEmail($notification));
                        $mail = 1;
                    }
                }
            }

            session()->put('Success', trans('alert.messageSentOk'));
            return redirect('/contact');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    /*===========================================
                       Backend
    =============================================*/


    public function getAllContacts()
    {
        $forms = Contact::orderBy('id', 'desc')->get();
        return view('AdminPanel.Contacts.Contacts',
            [
                'PageTitle' => 'إداره نماذج إتصل بنا',
                'forms' => $forms,
                'Active' => 'ContactForm',
            ]);
    }


    public function getSingleContact($CID)
    {
        $form = Contact::find($CID);
        $form->status = 'read';
        $form->update();
        return view('AdminPanel.Contacts.SingleContact',
            [
                'PageTitle' => 'تفاصيل الرساله',
                'form' => $form,
                'Active' => 'ContactForm',
            ]);
    }


    public function DeleteContact($CID)
    {
        $form = Contact::find($CID);
        $notifications = Notification::where('type', '=', 'contact')
            ->where('linked_id', '=', $CID)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        if ($form->delete()) {
            return Response::json($CID);
        } else {
            return Response::json("false");
        }
    }

    /*****
     * 
     * RegisterTrainers
     * 
     ****/
    public function getAllRegisterTrainers()
    {
        $forms = Applications::where('Type', 'RegisterTrainer')->orderBy('id', 'desc')->get();
        return view('AdminPanel.RegisterTrainers.RegisterTrainers',
            [
                'PageTitle' => 'إداره نماذج الاشتراك كمدرب',
                'forms' => $forms,
                'Active' => 'RegisterTrainerForm',
            ]);
    }


    public function getSingleRegisterTrainer($CID)
    {
        $form = Applications::find($CID);
        $form->Status = 'Read';
        $form->update();
        return view('AdminPanel.RegisterTrainers.SingleRegisterTrainer',
            [
                'PageTitle' => 'بيانات المشترك',
                'form' => $form,
                'Active' => 'RegisterTrainerForm',
            ]);
    }


    public function DeleteRegisterTrainer($CID)
    {
        $form = Applications::find($CID);
        $notifications = Notification::where('type', '=', 'RegisterTrainer')
            ->where('linked_id', '=', $CID)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        if ($form->delete()) {
            return Response::json($CID);
        } else {
            return Response::json("false");
        }
    }

    /*****
     * 
     * PersonalTrainings
     * 
     ****/
    public function getAllPersonalTrainings()
    {
        $forms = Applications::where('Type', 'PersonalTraining')->orderBy('id', 'desc')->get();
        return view('AdminPanel.PersonalTrainings.PersonalTrainings',
            [
                'PageTitle' => 'إداره نماذج الاشتراك الفردى',
                'forms' => $forms,
                'Active' => 'PersonalTrainingForm',
            ]);
    }


    public function getSinglePersonalTraining($CID)
    {
        $form = Applications::find($CID);
        $form->Status = 'Read';
        $form->update();
        return view('AdminPanel.PersonalTrainings.SinglePersonalTraining',
            [
                'PageTitle' => 'بيانات المشترك',
                'form' => $form,
                'Active' => 'PersonalTrainingForm',
            ]);
    }


    public function DeletePersonalTraining($CID)
    {
        $form = Applications::find($CID);
        $notifications = Notification::where('type', '=', 'PersonalTraining')
            ->where('linked_id', '=', $CID)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        if ($form->delete()) {
            return Response::json($CID);
        } else {
            return Response::json("false");
        }
    }

    /*****
     * 
     * CompaniesTrainings
     * 
     ****/
    public function getAllCompaniesTrainings()
    {
        $forms = Applications::where('Type', 'CompaniesTraining')->orderBy('id', 'desc')->get();
        return view('AdminPanel.CompaniesTrainings.CompaniesTrainings',
            [
                'PageTitle' => 'إداره نماذج اشتراك الشركات',
                'forms' => $forms,
                'Active' => 'CompaniesTrainingForm',
            ]);
    }


    public function getSingleCompaniesTraining($CID)
    {
        $form = Applications::find($CID);
        $form->Status = 'Read';
        $form->update();
        return view('AdminPanel.CompaniesTrainings.SingleCompaniesTraining',
            [
                'PageTitle' => 'بيانات المشترك',
                'form' => $form,
                'Active' => 'CompaniesTrainingForm',
            ]);
    }


    public function DeleteCompaniesTraining($CID)
    {
        $form = Applications::find($CID);
        $notifications = Notification::where('type', '=', 'CompaniesTraining')
            ->where('linked_id', '=', $CID)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        if ($form->delete()) {
            return Response::json($CID);
        } else {
            return Response::json("false");
        }
    }


}
