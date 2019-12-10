<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Setting;
use App\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Response;

class SettingsController extends Controller
{
    //
    /*
===================================================
            general settings
===================================================
*/
    public function getSettings()
    {
        $setting = Setting::get()->keyBy('key')->all();
        return view('AdminPanel.GeneralSettings.Settings')
            ->with([
                'PageTitle' => 'الإعدادات الرئيسية',
                'Active' => 'Settings',
                'setting' => $setting,
            ]);
    }


    public function getHomeSettings()
    {
        $setting = Setting::get()->keyBy('key')->all();
        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        $select_category['new'] = 'جديد الموقع';
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        return view('AdminPanel.StaticPages.Home')
            ->with([
                'PageTitle' => 'إعدادات الصفحه الرئيسيه / هيدر الموقع',
                'Active' => 'HomeSettings',
                'setting' => $setting,
                'select_category' => $select_category,
            ]);
    }

    public function getAboutSettings()
    {
        $setting = Setting::get()->keyBy('key')->all();
        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        $select_category['new'] = 'جديد الموقع';
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        return view('AdminPanel.StaticPages.About')
            ->with([
                'PageTitle' => 'إعدادات من نحن',
                'Active' => 'AboutSettings',
                'setting' => $setting,
                'select_category' => $select_category,
            ]);
    }


    public function UpdateSettings(Request $request)
    {
        $this->validate($request, [
            'logo'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'fav'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'socialPhoto'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'footer_image'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'partner_1'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'partner_2'=>'nullable|file|mimes:jpeg,jpg,png,gif',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'google' => 'nullable|url',
            'behance' => 'nullable|url',
            'mobile' => 'nullable|numeric|regex:/[0-9]{10}/',
            'phone' => 'nullable|numeric|regex:/[0-9]{10}/',
            'whatsApp' => 'nullable|numeric|regex:/[0-9]{10}/',
            'hotLine' => 'nullable|numeric',
            'fax' => 'nullable|numeric',
            'supportLine' => 'nullable|numeric',
            //'skype' => 'nullable|url',
            //'rss' => 'nullable|url',
            'notification_email' => 'nullable|email',
            'messages_email' => 'nullable|email',

        ]);

        //foreach inputs which is text ant textarea
        foreach ($_POST as $key => $value) {
            $countvalue = Setting::where('key', $key)->count();
            if ($countvalue > 0) {

                if ($key != '_token') {
                    $edit = Setting::where('key', $key)->first();
                    $edit->value = $value;
                    $edit->save();
                }
            } else {
                if ($key != '_token') {
                    $save = New Setting();
                    $save->key = $key;
                    $save->value = $value;
                    $save->LinkedID = '';
                    $save->save();
                }
            }
        }

        //foreach inputs which is file
        foreach ($_FILES as $key => $value) {
            //if thier was a file uploaded with in the post
            if ($request->hasFile($key)) {
                $FileExt = $request->$key->extension();

                //check if thier was an old file
                $countvalue = Setting::where('key', $key)->count();
                if ($countvalue > 0) {

                    $EditOldFile = Setting::where('key', $key)->first();
                    //delete old file and upload the new file

                    $image_path = base_path() . '/storage/app/Settings/' . $EditOldFile->value;
                    $delete_image = File::delete($image_path);

                    //Storage::delete($EditOldFile->value);
                    $request->$key->storeAs('Settings', $key . '.' . $FileExt);

                    $EditOldFile->value = $key . '.' . $FileExt;
                    $EditOldFile->save();

                } else {
                    $request->$key->storeAs('Settings', $key . '.' . $FileExt);
                    //return '<img src="'.asset('storage/app/public/Settings/'.$key.'.'.$FileExt).'" />';
                    $NewFile = New Setting;
                    $NewFile->key = $key;
                    $NewFile->value = $key . '.' . $FileExt;
                    $NewFile->LinkedID = '';
                    $NewFile->save();
                }
            }
        }


        session()->flash('Success', 'تم حفظ البيانات بنجاح!');
        return back();

    }


    /*
    ===================================================
                    Static Pages
    ===================================================
    */

    public function getDynamicPages()
    {
        $pages = StaticPage::orderBy('id', 'desc')->get();
        return view('AdminPanel.DynamicPages.DynamicPages')->with([
            'pages' => $pages,
            'PageTitle' => 'الصفحات الثابته',
            'Active' => 'DynamicPages',
        ]);
    }

    public function getCreateDynamicPage()
    {
        return view('AdminPanel.DynamicPages.CreateDynamicPage',
            [
                'PageTitle' => 'إضافه صفحه جديده',
                'Active' => 'DynamicPages',
            ]);
    }


    public function postCreateDynamicPage(Request $request)
    {
        $this->validate($request, [
            'page_nickName' => 'required|string|max:255|unique:static_pages,nickName',
            'page_name_ar' => 'nullable|string|max:255',
            'page_description_ar' => 'required',
            'page_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'publishDate' => 'nullable|date',
            'slug' => 'nullable|max:500',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        $page = New StaticPage();
        $page->nickName = $request['page_nickName'];
        $page->name_ar = $request['page_name_ar'];
        $page->content_ar = $request['page_description_ar'];
        $page->name_en = $request['page_name_en'];
        $page->content_en = $request['page_description_en'];
        $page->publishDate = $request['publishDate'];

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $page->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['page_nickName']);
            $page->slug = implode('-', $array);
        }

        $page->seo_title = $request['seo_title'];
        $page->seo_keywords = $request['seo_keywords'];
        $page->seo_description = $request['seo_description'];


        $day = date("d");
        $month = date("m");
        $year = date("Y");

        $page->day = $day;
        $page->month = $month;
        $page->year = $year;

        if ($page->save()) {
            if ($request->hasFile('page_image')) {
                $file = $request['page_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $page->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('pages/' . $page->id, $NewFileName);
                $page->image = $NewFileName;
                $page->update();
            }
            if ($request->hasFile('seo_image')) {
                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $page->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('pages/' . $page->id, $NewFileName);
                $page->seo_image = $NewFileName;
                $page->update();
            }
            session()->flash('Success', 'تم إضافه الصفحه بنجاح');
            return redirect('/AdminPanel/Pages/');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateDynamicPage($PID)
    {
        $page = StaticPage::find($PID);
        return view('AdminPanel.DynamicPages.UpdateDynamicPage')->with([
            'page' => $page,
            'PageTitle' => $page->name,
            'Active' => 'DynamicPages',
        ]);
    }


    public function postUpdateDynamicPage($PID, request $request)
    {
        $page = StaticPage::find($PID);

        $this->validate($request, [
            'page_nickName' => 'required|string|max:255|unique:static_pages,nickName,'.$PID,
            'page_name_ar' => 'nullable|string|max:255',
            'page_description_ar' => 'required',
            'page_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'publishDate' => 'nullable|date',
            'slug' => 'nullable|max:500',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        $page->nickName = $request['page_nickName'];
        $page->name_ar = $request['page_name_ar'];
        $page->content_ar = $request['page_description_ar'];
        $page->name_en = $request['page_name_en'];
        $page->content_en = $request['page_description_en'];
        $page->publishDate = $request['publishDate'];

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $page->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['page_nickName']);
            $page->slug = implode('-', $array);
        }

        $page->seo_title = $request['seo_title'];
        $page->seo_keywords = $request['seo_keywords'];
        $page->seo_description = $request['seo_description'];

        if ($page->update()) {

            if ($request->hasFile('page_image')) {
                $file_path = base_path() . '/storage/app/pages/' . $page->id . '/' . $page->image;
                File::delete($file_path);
                $file = $request['page_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $page->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('pages/' . $page->id, $NewFileName);
                $page->image = $NewFileName;
                $page->update();
            }
            if ($request->hasFile('seo_image')) {
                $file_path = base_path() . '/storage/app/pages/' . $page->id . '/' . $page->seo_image;
                File::delete($file_path);
                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $page->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('pages/' . $page->id, $NewFileName);
                $page->seo_image = $NewFileName;
                $page->update();
            }
            session()->flash('Success', 'تم تعديل الصفحه بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteDynamicPage($PID)
    {
        $page = StaticPage::find($PID);
        $FolderPath = base_path() . '/storage/app/pages/' . $page->id;
        if (File::exists($FolderPath)) {
            File::deleteDirectory($FolderPath);
        }
        if ($page->delete()) {
            return Response::json($PID);
        } else {
            return Response::json("false");
        }
    }

    public function DeleteDynamicPagePhoto($PID, $Photo, $X)
    {
        $page = StaticPage::find($PID);
        $photoPath = base_path() . '/storage/app/pages/' . $page->id . '/' . $Photo;
        if (File::exists($photoPath)) {
            $DeletePhoto = File::delete($photoPath);
            $page->image = '';
            $page->update();
            if ($DeletePhoto) {
                return Response::json($X);
            } else {
                return Response::json("false");
            }
        }
    }

    public function DeleteSeoImage($LinkedID, $Photo, $X, $SeoType)
    {
        if ($SeoType == 'DynamicPage') {
            $parent = StaticPage::find($LinkedID);
            $photoPath = base_path() . '/storage/app/pages/' . $parent->id . '/' . $Photo;
        }
        if ($SeoType == 'Category') {
            $parent = Category::find($LinkedID);
            $photoPath = base_path() . '/storage/app/categories/' . $parent->id . '/' . $Photo;
        }

        if ($SeoType == 'Article') {
            $parent = Article::find($LinkedID);
            $photoPath = base_path() . '/storage/app/articles/' . $parent->id . '/' . $Photo;
        }

        if (File::exists($photoPath)) {
            $DeletePhoto = File::delete($photoPath);
            $parent->seo_image = '';
            $parent->update();
            if ($DeletePhoto) {
                return Response::json($X);
            } else {
                return Response::json("false");
            }
        }

    }


    public function DeleteImage( $Type,$Image,$X)
    {

        if ($Type == 'partner_1'||$Type == 'partner_2'||$Type == 'logo'||$Type == 'fav' ||$Type == 'socialPhoto' || $Type == 'footer_image') {
            $setting = Setting::where('key', $Type)->first();
            $photoPath = base_path() . '/storage/app/Settings/' . $Image;
            $setting->value = '';
            $setting->update();
        }else {
            $setting = Setting::where('key', $Type)->first();
            $photoPath = base_path() . '/storage/app/Settings/' . $Image;
            $setting->value = '';
            $setting->update();
        }
        /* if ($Type == 'StaticPage') {
            $parent = StaticPage::find($ID);
            $photoPath = base_path() . '/storage/app/pages/' . $parent->id . '/' . $Image;
            $parent->image='';
            $parent->update();
        }*/


        if (File::exists($photoPath)) {
            $DeletePhoto = File::delete($photoPath);

            if ($DeletePhoto) {
                return Response::json($X);
            } else {
                return Response::json("false");
            }
        }

    }

}
