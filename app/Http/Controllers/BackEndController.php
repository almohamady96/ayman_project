<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Article;
use App\Category;
use App\Menu;
use App\MenuItem;
use App\Notification;
use App\Questionnaire;
use App\Role;
use App\Image;
use App\StaticPage;
use App\Widget;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Response;

class BackEndController extends Controller
{
    //
    public function AdminIndex()
    {
        return view('AdminPanel.index',
            [
                'PageTitle' => 'لوحة التحكم',
                'Active' => 'Index',
            ]);
    }


    public function getUpdateProfile()
    {
        $user = Auth::user();
        $roles = Role::all();
        $select_role = [];
        foreach ($roles as $role) {
            $select_role[$role->id] = $role->name;
        }

        return view('AdminPanel.Profile.UpdateProfile',
            [
                'PageTitle' => 'إعدادات الحساب',
                'Active' => 'Profile',
                'user' => $user,
                'select_role' => $select_role,
            ]);
    }


    public function postUpdateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'userName' => 'required|string|min:2|max:60',
            'uniqueName' => 'required|alpha_dash|min:5|max:30|unique:users,uniqueName,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|numeric|regex:/[0-9]{10}/|unique:users,mobile,' . $user->id,
            'whatsApp' => 'nullable|numeric|regex:/[0-9]{10}/|unique:users,whatsApp,' . $user->id,
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|alpha_dash|min:6|max:70',
            'password_confirmation' => 'nullable|required_unless:password,!=,""|same:password',
        ], [
            'password_confirmation.required_unless' => 'من فضلك أدخل تأكيد كلمه المرور',
        ]);

        $user->name = $request['userName'];
        $user->uniqueName = $request['uniqueName'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->whatsApp = $request['whatsApp'];
        $user->address = $request['address'];
        if ($request->password != '') {
            $user->password = bcrypt($request['password']);
        }
        if ($user->update()) {
            session()->flash('Success', 'تم تعديل بيانات العضويه بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    /*=========================================
               categories operations
    ===========================================*/

    public function getAllCategories()
    {
        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        return view('AdminPanel.Categories.Categories',
            [
                'PageTitle' => 'إدارة الأقسام',
                'Active' => 'Categories',
                'categories' => $categories,
            ]);
    }


    public function getCreateCategory()
    {
        $categories = Category::where('category_id', '=', null)
            ->where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        $select_category[null] = 'إضافه كـ قسم رئيسي';

        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }
        return view('AdminPanel.Categories.CreateCategory',
            [
                'PageTitle' => 'إضافه قسم جديد',
                'Active' => 'Categories',
                'select_category' => $select_category,
            ]);
    }


    public function postCreateCategory(Request $request)
    {
        $this->validate($request, [
            'category_name_ar' => 'required|string|max:255',
            'category_description' => 'nullable',
            'category_id' => 'nullable|numeric',
            'isFeature' => 'required',
            //'category_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'slug' => 'nullable|max:500',
            'number' => 'nullable|numeric',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        $category = New Category();
        $category->name_ar = $request['category_name_ar'];
        $category->name_en = $request['category_name_en'];
        $category->description = $request['category_description'];
        $category->category_id = $request['category_id'];
        $category->isFeature = $request['isFeature'];
        $category->isFeatureTime = strtotime('now');

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $category->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['category_name']);
            $category->slug = implode('-', $array);
        }

        $category->number = $request['number'];
        $category->seo_title = $request['seo_title'];
        $category->seo_keywords = $request['seo_keywords'];
        $category->seo_description = $request['seo_description'];


        $day = date("d");
        $month = date("m");
        $year = date("Y");

        $category->day = $day;
        $category->month = $month;
        $category->year = $year;

        if ($category->save()) {

            if ($request->hasFile('category_image')) {
                $file = $request['category_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $category->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('categories/' . $category->id, $NewFileName);
                $category->image = $NewFileName;
                $category->update();
            }
            if ($request->hasFile('seo_image')) {
                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $category->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('categories/' . $category->id, $NewFileName);
                $category->seo_image = $NewFileName;
                $category->update();
            }
            session()->flash('Success', 'تم إضافه القسم بنجاح');
            return redirect('/AdminPanel/Categories/');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateCategory($CID)
    {
        $category = Category::find($CID);
        $categories = Category::where('category_id', '=', null)
            ->where('id', '!=', $category->id)
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        $select_category[null] = 'إضافه كـ قسم رئيسي';

        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $select_category[$cate->id] = $cate->name;
            } else {
                $select_category[$cate->id] = $cate->name . ' ( مؤرشف حالياً ) ';
            }
        }

        if ($category->category_id != null && !Category::where('id', '=', $category->category_id)->exists()) {
            $select_category[$category->category_id] = 'تم حذف القسم';
        }
        return view('AdminPanel.Categories.UpdateCategory',
            [
                'PageTitle' => $category->name,
                'Active' => 'Categories',
                'category' => $category,
                'select_category' => $select_category,
            ]);
    }


    public function postUpdateCategory($CID, Request $request)
    {
        $category = Category::find($CID);

        $this->validate($request, [
            'category_name_ar' => 'required|string|max:255',
            'category_name_en' => 'required|string|max:255',
            'category_description_ar' => 'nullable',
            'category_description_en' => 'nullable',
            'category_id' => 'nullable|numeric',
            'isFeature' => 'required',
            'status' => 'required',
            //'category_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'slug' => 'nullable|max:500',
            'number' => 'nullable|numeric',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);
        $category->name_ar = $request['category_name_ar'];
        $category->name_en = $request['category_name_en'];
        $category->description_ar = $request['category_description_ar'];
        $category->description_en = $request['category_description_en'];
        $category->category_id = $request['category_id'];
        $category->isFeature = $request['isFeature'];
        if ($category->isFeature != $request['isFeature']) {
            $category->isFeatureTime = strtotime('now');
        }

        $category->design_template = $request['design_template'];

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $category->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['category_name']);
            $category->slug = implode('-', $array);
        }

        $category->number = $request['number'];
        $category->seo_title = $request['seo_title'];
        $category->seo_keywords = $request['seo_keywords'];
        $category->seo_description = $request['seo_description'];

        $category->status = $request['status'];
        if ($category->update()) {

            if ($request->hasFile('category_image')) {
                $file_path = base_path() . '/storage/app/categories/' . $category->id . '/' . $category->image;
                File::delete($file_path);
                $file = $request['category_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $category->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('categories/' . $category->id, $NewFileName);
                $category->image = $NewFileName;
                $category->update();
            }
            if ($request->hasFile('seo_image')) {
                $file_path = base_path() . '/storage/app/categories/' . $category->id . '/' . $category->seo_image;
                File::delete($file_path);
                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $category->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('categories/' . $category->id, $NewFileName);
                $category->seo_image = $NewFileName;
                $category->update();
            }
            session()->flash('Success', 'تم تعديل القسم بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteCategory($CID)
    {
        $category = Category::find($CID);
        $FolderPath = base_path() . '/storage/app/categories/' . $category->id;
        if (File::exists($FolderPath)) {
            File::deleteDirectory($FolderPath);
        }

        $articles = Article::where('category_id', '=', $category->id)
            ->get();
        foreach ($articles as $article) {
            $FolderPath = base_path() . '/storage/app/articles/' . $article->id;
            if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        }
        if ($category->delete()) {
            return Response::json($CID);
        } else {
            return Response::json("false");
        }
    }


    public function DeleteCategoryImage($CID, $Img, $X)
    {
        $category = Category::find($CID);
        $imgPath = base_path() . '/storage/app/categories/' . $category->id . '/' . $Img;
        if (File::exists($imgPath)) {
            $DeletePhoto = File::delete($imgPath);
            $category->image = '';
            $category->update();
            if ($DeletePhoto) {
                return Response::json($X);
            } else {
                return Response::json("false");
            }
        }
    }


    /*==================================================
                    Articles operations
    ====================================================*/


    public function getAllArticles()
    {
        $articles = Article::orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Articles.Articles',
            [
                'PageTitle' => 'كل المقالات',
                'Active' => 'Articles',
                'articles' => $articles,
            ]);
    }


    public function getCreateArticle()
    {
        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name_ar;
        }

        return view('AdminPanel.Articles.CreateArticle',
            [
                'PageTitle' => 'إضافه مقال جديد',
                'Active' => 'Articles',
                'select_category' => $select_category,
            ]);
    }


    public function postCreateArticle(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'article_author' => 'nullable|max:180',
            'article_name_ar' => 'required|max:180',
            'article_name_en' => 'required|max:180',
            'article_summary' => 'nullable|max:670',
            'article_description_ar' => 'required',
            'article_description_en' => 'required',
            //'article_isFeature' => 'required',
            'article_file_type' => 'required',
            'publishDate' => 'nullable|date',
            'article_image' => 'required|file|mimes:jpeg,jpg,png,gif',

            'slug' => 'nullable|max:500',
            //'number' => 'nullable|numeric',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        if ($request['article_file_type'] == 'video_file') {
            $this->validate($request, [
                'article_file' => 'required|file|mimes:mp4,mkv,flv,avi,webm,mpeg,ogv',
            ]);
        }

        if ($request['article_file_type'] == 'image') {
            $this->validate($request, [
                'article_file' => 'required|file|mimes:jpeg,jpg,png,gif',
            ]);
        }

        if ($request['article_file_type'] == 'image360') {
            $this->validate($request, [
                'article_file_link' => 'required|url',
            ], [
                'article_file_link.url' => 'من فضلك أدخل رابط الصوره بشكل صحيح',
            ]);
        }
        if ($request['article_file_type'] == 'slider') {
            $this->validate($request, [
                'article_photos.*' => 'required|file|mimes:jpeg,jpg,png,gif',
            ], [
                'article_photos.*.file' => 'صور الإسلايدر الداخلي للمقال يجب أن تكون بأحد الصيغ التاليه : jpeg,jpg,png,gif '
            ]);
        }

        if ($request['article_file_type'] == 'youtube' || $request['article_file_type'] == 'vimeo') {
            $this->validate($request, [
                'article_file_link' => 'required|url'
            ]);
        }

        if ($request['article_file_type'] == 'youtube' && !preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request['article_file_link'])) {
            session()->flash('Faild', 'عفواً رابط اليويتوب غير صالح ');
            return back()->withInput();

        }
        if ($request['article_file_type'] == 'vimeo' && strpos($request['article_file_link'], 'https://vimeo.com') === false) {
            session()->flash('Faild', 'عفواً رابط فيمو غير صالح .. يجب إدخال الرابط بصيغه  https://vimeo.com/75124475');
            return back()->withInput();

        }

        $article = new Article();
        $article->category_id = $request['category_id'];
        $article->author = $request['article_author'];
        $article->name_ar = $request['article_name_ar'];
        $article->name_en = $request['article_name_en'];
        $article->summary = $request['article_summary'];
        $article->description_ar = $request['article_description_ar'];
        $article->description_en = $request['article_description_en'];
        /*$article->isFeature = $request['article_isFeature'];
        $article->isFeatureTime = strtotime('now');*/

        $article->file_type = $request['article_file_type'];
        $article->publishDate = $request['publishDate'];

        $article->link = $request['article_file_link'];

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $article->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['article_name_ar']);
            $article->slug = implode('-', $array);
        }

        //$article->number = $request['number'];
        $article->seo_title = $request['seo_title'];
        $article->seo_keywords = $request['seo_keywords'];
        $article->seo_description = $request['seo_description_ar'];

        //get day, month and year for the session date

        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $article->day = $day;
        $article->month = $month;
        $article->year = $year;

        if ($article->save()) {

            if ($request->hasFile('article_image')) {
                $file = $request['article_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->image = $NewFileName;
                $article->update();
            }

            if ($request->hasFile('article_file')) {
                $file = $request['article_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->file = $NewFileName;
                $article->update();
            }

            $photos = [];
            if ($request->hasFile('article_photos')) {
                $x = 1;
                foreach ($request['article_photos'] as $file) {
                    $FileExt = $file->extension();
                    $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                    $file->storeAs('articles/' . $article->id . '/photos/', $NewFileName);
                    array_push($photos, $NewFileName);
                    $x++;
                }
                $article->photos = base64_encode(serialize($photos));
                $article->update();
            }

            if ($request->hasFile('seo_image')) {
                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->seo_image = $NewFileName;
                $article->update();
            }

            session()->flash('Success', 'تم إضافه المقال بنجاح');
            return redirect('/AdminPanel/Categories/' . $article->category_id . '/Articles');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateArticle($PID)
    {
        $article = Article::find($PID);

        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        $select_category = [];
        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_category[$cate->id] = $cate->name_ar . $status;
        }

        return view('AdminPanel.Articles.UpdateArticle',
            [
                'PageTitle' => $article->name,
                'Active' => 'Articles',
                'select_category' => $select_category,
                'article' => $article,
            ]);
    }


    public function postUpdateArticle($PID, Request $request)
    {
        $article = Article::find($PID);
        $this->validate($request, [
            'category_id' => 'required',
            'article_author' => 'nullable|max:180',
            'article_name_ar' => 'required|max:180',
            'article_name_en' => 'required|max:180',
            'article_summary' => 'nullable|max:670',
            'article_description_ar' => 'required',
            'article_description_en' => 'required',
            //'article_isFeature' => 'required',
            'article_file_type' => 'required',
            'publishDate' => 'nullable|date',
            'article_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',

            'slug' => 'nullable|max:500',
            //'number' => 'nullable|numeric',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'seo_image' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ]);

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'video_file') {
            $this->validate($request, [
                'article_file' => 'required|file|mimes:mp4,mkv,flv,avi,webm,mpeg,ogv',
            ]);
        }

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'image') {
            $this->validate($request, [
                'article_file' => 'required|file|mimes:jpeg,jpg,png,gif',
            ]);
        }

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'image360') {
            $this->validate($request, [
                'article_file_link' => 'required|url',
            ], [
                'article_file_link.url' => 'من فضلك أدخل رابط الصوره بشكل صحيح',
            ]);
        }

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'slider') {
            $this->validate($request, [
                'article_photos.*' => 'required|file|mimes:jpeg,jpg,png,gif',
            ], [
                'article_photos.*.file' => 'صور الإسلايدر الداخلي للمقال يجب أن تكون بأحد الصيغ التاليه : jpeg,jpg,png,gif '
            ]);
        }

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'youtube' || $request['article_file_type'] == 'vimeo') {
            $this->validate($request, [
                'article_file_link' => 'required|url'
            ]);
        }

        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'youtube' && !preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request['article_file_link'])) {
            session()->flash('Faild', 'عفواً رابط اليويتوب غير صالح ');
            return back()->withInput();

        }
        if ($article->file_type != $request['article_file_type'] && $request['article_file_type'] == 'vimeo' && strpos($request['article_file_link'], 'https://vimeo.com') === false) {
            session()->flash('Faild', 'عفواً رابط فيمو غير صالح .. يجب إدخال الرابط بصيغه  https://vimeo.com/75124475');
            return back()->withInput();

        }

        $article->author = $request['article_author'];
        $article->category_id = $request['category_id'];
        $article->name_ar = $request['article_name_ar'];
        $article->name_en = $request['article_name_en'];
        $article->summary = $request['article_summary'];
        $article->description_ar = $request['article_description_ar'];
        $article->description_en = $request['article_description_en'];
        /*
            $article->isFeature = $request['article_isFeature'];
            if ($article->isFeature != $request['article_isFeature']) {
            $article->isFeatureTime = strtotime('now');
        }*/
        $article->file_type = $request['article_file_type'];
        $article->publishDate = $request['publishDate'];
        $article->link = $request['article_file_link'];

        if ($request['slug'] != '') {
            $array = explode(' ', $request['slug']);
            $article->slug = implode('-', $array);
        } else {
            $array = explode(' ', $request['article_name']);
            $article->slug = implode('-', $array);
        }

        //$article->number = $request['number'];
        $article->seo_title = $request['seo_title'];
        $article->seo_keywords = $request['seo_keywords'];
        $article->seo_description = $request['seo_description_ar'];

        $article->status = $request['status'];

        if ($article->update()) {

            if ($request->hasFile('article_image')) {
                $file_path = base_path() . '/storage/app/articles' . $article->id . '/' . $article->image;
                File::delete($file_path);

                $file = $request['article_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->image = $NewFileName;
                $article->update();
            }


            if ($request->hasFile('article_file')) {
                $file_path = base_path() . '/storage/app/articles' . $article->id . '/' . $article->file;
                File::delete($file_path);

                $file = $request['article_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->file = $NewFileName;
                $article->update();
            }

            if ($article->photos != '') {
                $photos = unserialize(base64_decode($article->photos));
            } else {
                $photos = [];
            }
            if ($request->hasFile('article_photos')) {
                $x = 1;
                foreach ($request['article_photos'] as $file) {
                    $FileExt = $file->extension();
                    $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                    $file->storeAs('articles/' . $article->id . '/photos/', $NewFileName);
                    array_push($photos, $NewFileName);
                    $x++;
                }
                $article->photos = base64_encode(serialize($photos));
                $article->update();
            }


            if ($request->hasFile('seo_image')) {
                $file_path = base_path() . '/storage/app/articles/' . $article->id . '/' . $article->seo_image;
                File::delete($file_path);

                $file = $request['seo_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $article->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('articles/' . $article->id, $NewFileName);
                $article->seo_image = $NewFileName;
                $article->update();
            }

            session()->flash('Success', 'تم تعديل المقال بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteArticlePhoto($PID, $Photo, $x)
    {
        $article = Article::find($PID);
        $photo_path = base_path() . '/storage/app/articles/' . $article->id . '/photos/' . $Photo;
        $arr = unserialize(base64_decode($article->photos));
        $key = array_search($Photo, $arr);
        if (File::exists($photo_path)) {
            $delete_photo = File::delete($photo_path);
            if ($delete_photo) {
                unset($arr[$key]);
                return Response::json($x);
            } else {
                return Response::json("false");
            }
        }
    }


    public function DeleteArticle($PID)
    {
        $article = Article::find($PID);
        $FolderPath = base_path() . '/storage/app/articles/' . $article->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);


        if ($article->delete()) {
            return Response::json($PID);
        } else {
            return Response::json("false");
        }
    }
    
    public function postUploadPhotosArticle(Request $request)
    {
        //$imgpath = request()->file('file')->store('storage/app', 'public');
        $file = $request['file'];
        $FileExt = $file->extension();
        $NewFileName = time() . '_' . rand(1, 99999999) . '.' . $FileExt;
        $file->storeAs('uploads', $NewFileName);
        return response()->json(['location' => url('/storage/app/uploads/'.$NewFileName)]);

    }

    /*==================================================
               category articles operations
    ====================================================*/


    public function getCategoryArticles($CID)
    {
        $category = Category::find($CID);
        $articles = Article::where('category_id', '=', $category->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Articles.Articles',
            [
                'PageTitle' => $category->name,
                'Active' => 'Categories',
                'category' => $category,
                'articles' => $articles,
            ]);
    }


    public function getCreateCategoryArticle($CID)
    {
        $category = Category::find($CID);
        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name_ar;
        }

        return view('AdminPanel.Articles.CreateArticle',
            [
                'PageTitle' => 'إضافه مقال جديد',
                'Active' => 'Categories',
                'select_category' => $select_category,
                'category' => $category,
            ]);
    }


    public function getUpdateCategoryArticle($CateID, $PID)
    {

        $category = Category::find($CateID);
        $article = Article::where('id', '=', $PID)
            ->where('category_id', '=', $category->id)
            ->first();

        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        $select_category = [];
        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_category[$cate->id] = $cate->name_ar . $status;
        }


        return view('AdminPanel.Articles.UpdateArticle',
            [
                'PageTitle' => $article->name_ar,
                'article' => $article,
                'category' => $category,
                'Active' => 'Categories',
                'select_category' => $select_category,
            ]);
    }


    /*=========================================
                 questionnaire operations
    ===========================================*/

    public function getAllQuestionnaires()
    {
        $questionnaires = Questionnaire::orderBy('id', 'desc')->get();

        return view('AdminPanel.Questionnaires.Questionnaires',
            [
                'PageTitle' => 'إداره الإستفتاءات',
                'Active' => 'Questionnaires',
                'questionnaires' => $questionnaires,
            ]);
    }


    public function getCreateQuestionnaire()
    {
        $select_position = [
            'top_single' => 'أعلي الشريط الجانبي للصفحات الداخليه',
            'bottom_single' => 'أسفل الشريط الجانبي للصفحات الداخليه',
            'top_archive' => 'أعلي الشريط الجانبي للصفحات الخارجيه',
            'bottom_archive' => 'أسفل الشريط الجانبي للصفحات الخارجيه',
        ];

        return view('AdminPanel.Questionnaires.CreateQuestionnaire',
            [
                'PageTitle' => ' إضافه إستفتاء جديد',
                'Active' => 'Questionnaires',
                'select_position' => $select_position,
            ]);
    }


    public function postCreateQuestionnaire(Request $request)
    {
        $this->validate($request, [
            'questionnaire_q' => 'required|max:400',
            'questionnaire_a1' => 'required|max:400',
            'questionnaire_a2' => 'required|max:400',
            'questionnaire_a3' => 'nullable|max:400',
            'questionnaire_a4' => 'nullable|max:400',
            'questionnaire_a5' => 'nullable|max:400',
            //'questionnaire_position' => 'required',
            'questionnaire_publishDate' => 'required|date',
            'questionnaire_expireDate' => 'required|date|after:questionnaire_publishDate',
            'number' => 'nullable|numeric',
        ]);
        if (strtotime($request['questionnaire_expireDate'] < strtotime('now'))) {
            session()->flash('Faild', 'عفواً تاريخ إنتهاء الإستفتاء يجب أن يكون أكبر من الوقت الحالي');
            return back()->withInput();
        }

        $questionnaire = New Questionnaire();
        $questionnaire->q = $request['questionnaire_q'];
        $questionnaire->a1 = $request['questionnaire_a1'];
        $questionnaire->a2 = $request['questionnaire_a2'];
        $questionnaire->a3 = $request['questionnaire_a3'];
        $questionnaire->a4 = $request['questionnaire_a4'];
        $questionnaire->a5 = $request['questionnaire_a5'];
        //$questionnaire->position = $request['questionnaire_position'];
        $questionnaire->publishDate = $request['questionnaire_publishDate'];
        $questionnaire->publishTime = strtotime($request['questionnaire_publishDate']);
        $questionnaire->expireDate = $request['questionnaire_expireDate'];
        $questionnaire->expireTime = strtotime($request['questionnaire_expireDate']);
        $questionnaire->number = $request['number'];

        if ($questionnaire->save()) {
            session()->flash('Success', 'تم إضافه الإستفتاء بنجاح بنجاح');
            return redirect('/AdminPanel/Questionnaires');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateQuestionnaire($QID)
    {
        $questionnaire = Questionnaire::find($QID);
        $select_position = [
            'top_single' => 'أعلي الشريط الجانبي للصفحات الداخليه',
            'bottom_single' => 'أسفل الشريط الجانبي للصفحات الداخليه',
            'top_archive' => 'أعلي الشريط الجانبي للصفحات الخارجيه',
            'bottom_archive' => 'أسفل الشريط الجانبي للصفحات الخارجيه',
        ];

        return view('AdminPanel.Questionnaires.UpdateQuestionnaire',
            [
                'PageTitle' => $questionnaire->name,
                'Active' => 'Questionnaires',
                'questionnaire' => $questionnaire,
                'select_position' => $select_position,
            ]);
    }


    public function postUpdateQuestionnaire($QID, Request $request)
    {
        $questionnaire = Questionnaire::find($QID);

        $this->validate($request, [
            'questionnaire_q' => 'required|max:400',
            'questionnaire_a1' => 'required|max:400',
            'questionnaire_a2' => 'required|max:400',
            'questionnaire_a3' => 'nullable|max:400',
            'questionnaire_a4' => 'nullable|max:400',
            'questionnaire_a5' => 'nullable|max:400',
            //'questionnaire_position' => 'required',
            'questionnaire_publishDate' => 'required|date',
            'questionnaire_expireDate' => 'required|date|after:questionnaire_publishDate',
            'number' => 'nullable|numeric',
        ]);

        /*        if(strtotime($request['questionnaire_expireDate']) < strtotime('now')){
                    return 'less';
                }else{
                    return 'more' . strtotime($request['questionnaire_expireDate']);
                }*/

        /*        return 'old'.strtotime($questionnaire->expireDate)
                    .'<br>'
                    .'new'.strtotime($request['questionnaire_expireDate'])
                    .'<br>'
                    .'now'.strtotime('now');*/
        if ($request['status'] == 'active' && (strtotime($request['questionnaire_expireDate']) < strtotime('now'))) {
            $questionnaire->publishDate = $request['questionnaire_publishDate'];
            $questionnaire->publishTime = strtotime($request['questionnaire_publishDate']);
            $questionnaire->expireDate = $request['questionnaire_expireDate'];
            $questionnaire->expireTime = strtotime($request['questionnaire_expireDate']);
            $questionnaire->status = 'inactive';
            $questionnaire->update();
            session()->flash('Faild', 'عفواً تاريخ إنتهاء الإستفتاء يجب أن يكون أكبر من الوقت الحالي لتتمكن من تفعيل الإستفتاء');
            return back()->withInput();
        } else {
            $questionnaire->status = $request['status'];
        }

        $questionnaire->q = $request['questionnaire_q'];
        $questionnaire->a1 = $request['questionnaire_a1'];
        $questionnaire->a2 = $request['questionnaire_a2'];
        $questionnaire->a3 = $request['questionnaire_a3'];
        $questionnaire->a4 = $request['questionnaire_a4'];
        $questionnaire->a5 = $request['questionnaire_a5'];
        //$questionnaire->position = $request['questionnaire_position'];
        $questionnaire->publishDate = $request['questionnaire_publishDate'];
        $questionnaire->publishTime = strtotime($request['questionnaire_publishDate']);
        $questionnaire->expireDate = $request['questionnaire_expireDate'];
        $questionnaire->expireTime = strtotime($request['questionnaire_expireDate']);
        $questionnaire->number = $request['number'];

        if ($questionnaire->update()) {
            session()->flash('Success', 'تم تعديل الإستفتاء بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteQuestionnaire($QID)
    {
        $questionnaire = Questionnaire::find($QID);
        if ($questionnaire->delete()) {
            return Response::json($QID);
        } else {
            return Response::json("false");
        }
    }


    /*==================================================
                    Widgets operations
    ====================================================*/


    public function getAllWidgets()
    {
        $widgets = Widget::orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Widgets.Widgets',
            [
                'PageTitle' => 'كل الودجات',
                'Active' => 'Widgets',
                'widgets' => $widgets,
            ]);
    }


    public function getCreateWidget()
    {
        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        if (count($categories) != 0) {
            $select_category[0] = 'كل الأقسام';
        }
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        $questionnaires = Questionnaire::where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('status', '=', 'active')
            ->orderBy('id', 'desc')->get();
        $select_questionnaire = [];
        foreach ($questionnaires as $quest) {
            $select_questionnaire[$quest->id] = $quest->q;
        }

        $ads = Ad::where('type', '=', 'sidebar')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('status', '=', 'active')
            ->orderBy('id', 'desc')->get();
        $select_ad = [];

        foreach ($ads as $ad) {
            $select_ad[$ad->id] = $ad->name;
        }

        $articles = Article::where('status', '=', 'published')
            ->orderBy('id', 'desc')
            ->get();
        $select_article = [];
        foreach ($articles as $article) {
            $select_article[$article->id] = $article->name;
        }

        $select_widget_type = [
            'articles' => 'قائمه مقالات',
            'slider' => 'إسلايدر مقالات',
            'feature_article' => 'مقال مميز',
            'questionnaire' => 'إستفتاء',
            'ad' => 'إعلان',
        ];

        return view('AdminPanel.Widgets.CreateWidget',
            [
                'PageTitle' => 'إضافه ودجت جديد',
                'Active' => 'Widgets',
                'select_category' => $select_category,
                'select_questionnaire' => $select_questionnaire,
                'select_ad' => $select_ad,
                'select_article' => $select_article,
                'select_widget_type' => $select_widget_type,
            ]);
    }


    public function postCreateWidget(Request $request)
    {
        $this->validate($request, [
            'widget_name' => 'nullable|required_unless:widget_type,!=,ad|string|max:40',
            'widget_type' => 'required',
            'widget_count' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'widget_category_id' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'widget_ad_id' => 'nullable|required_if:widget_type,=,ad',
            'widget_article_id' => 'nullable|required_if:widget_type,=,feature_article',
            'widget_questionnaire_id' => 'nullable|required_if:widget_type,=,questionnaire',
            'widget_query_type' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'number' => 'nullable|numeric',
        ], [
            'widget_name.required_unless' => 'من فضلك أدخل عنوان الودجت',
            'widget_count.required_if' => 'من فضلك أدخل عدد المقالات',
            'widget_category_id.required_if' => 'من فضلك إختر القسم',
            'widget_ad_id.required_if' => 'من فضلك إختر الإعلان',
            'widget_article_id.required_if' => 'من فضلك إختر المقال المميز',
            'widget_questionnaire_id.required_if' => 'من فضلك إختر الإستفتاء',
            'widget_query_type.required_if' => 'من فضلك إختر نوع المقالات',
        ]);

        $widget = new Widget();
        $widget->name = $request['widget_name'];
        $widget->type = $request['widget_type'];

        if ($request['widget_type'] == 'articles') {
            if ($request['widget_category_id'] != 0){
                $widget->category_id = $request['widget_category_id'];
            }else{
                $widget->category_id = null;
            }
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = $request['widget_query_type'];
            $widget->count = $request['widget_count'];
        }
        elseif ($request['widget_type'] == 'slider') {
            if ($request['widget_category_id'] != 0){
                $widget->category_id = $request['widget_category_id'];
            }else{
                $widget->category_id = null;
            }
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = $request['widget_query_type'];
            $widget->count = $request['widget_count'];
        }
        elseif ($request['widget_type'] == 'feature_article') {
            $widget->category_id = null;
            $widget->article_id = $request['widget_article_id'];
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = null;
            $widget->count = null;
        }
        elseif ($request['widget_type'] == 'questionnaire') {
            $widget->category_id = null;
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = $request['widget_questionnaire_id'];
            $widget->query_type = null;
            $widget->count = null;
        }
        else {
            $widget->category_id = null;
            $widget->article_id = null;
            $widget->ad_id = $request['widget_ad_id'];
            $widget->questionnaire_id = null;
            $widget->query_type = null;
            $widget->count = null;
        }

        $widget->number = $request['number'];

        //get day, month and year for the session date

        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $widget->day = $day;
        $widget->month = $month;
        $widget->year = $year;

        if ($widget->save()) {
            session()->flash('Success', 'تم إضافه الودجت بنجاح');
            return redirect('/AdminPanel/Widgets/');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateWidget($PID)
    {
        $widget = Widget::find($PID);

        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        if (count($categories) != 0) {
            $select_category[0] = 'كل الأقسام';
        }
        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_category[$cate->id] = $cate->name . $status;
        }

        $questionnaires = Questionnaire::where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->orderBy('id', 'desc')->get();
        $select_questionnaire = [];
        foreach ($questionnaires as $quest) {
            if ($quest->status == 'active') {
                $status = '';
            } else {
                $status = ' ( غير نشط حالياً ) ';
            }
            $select_questionnaire[$quest->id] = $quest->q . $status;
        }

        $ads = Ad::where('type', '=', 'sidebar')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->orderBy('id', 'desc')->get();
        $select_ad = [];
        foreach ($ads as $ad) {
            if ($ad->status == 'active') {
                $status = '';
            } else {
                $status = ' ( غير نشط حالياً ) ';
            }
            $select_ad[$ad->id] = $ad->name . $status;
        }

        $articles = Article::where('status', '=', 'published')
            ->orderBy('id', 'desc')
            ->get();
        $select_article = [];
        foreach ($articles as $article) {
            if ($article->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_article[$article->id] = $article->name . $status;
        }

        $select_widget_type = [
            'articles' => 'قائمه مقالات',
            'slider' => 'إسلايدر مقالات',
            'feature_article' => 'مقال مميز',
            'questionnaire' => 'إستفتاء',
            'ad' => 'إعلان',
        ];


        return view('AdminPanel.Widgets.UpdateWidget',
            [
                'PageTitle' => $widget->name,
                'Active' => 'Widgets',
                'widget' => $widget,
                'select_category' => $select_category,
                'select_questionnaire' => $select_questionnaire,
                'select_ad' => $select_ad,
                'select_article' => $select_article,
                'select_widget_type' => $select_widget_type,
            ]);
    }


    public function postUpdateWidget($PID, Request $request)
    {
        $widget = Widget::find($PID);
        $this->validate($request, [
            'widget_name' => 'nullable|required_unless:widget_type,!=,ad|string|max:40',
            'widget_type' => 'required',
            'widget_count' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'widget_category_id' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'widget_ad_id' => 'nullable|required_if:widget_type,=,ad',
            'widget_article_id' => 'nullable|required_if:widget_type,=,feature_article',
            'widget_questionnaire_id' => 'nullable|required_if:widget_type,=,questionnaire',
            'widget_query_type' => 'nullable|required_if:widget_type,=,slider|required_if:widget_type,=,articles',
            'number' => 'nullable|numeric',
        ], [
            'widget_name.required_unless' => 'من فضلك أدخل عنوان الودجت',
            'widget_count.required_if' => 'من فضلك أدخل عدد المقالات',
            'widget_category_id.required_if' => 'من فضلك إختر القسم',
            'widget_ad_id.required_if' => 'من فضلك إختر الإعلان',
            'widget_article_id.required_if' => 'من فضلك إختر المقال المميز',
            'widget_questionnaire_id.required_if' => 'من فضلك إختر الإستفتاء',
            'widget_query_type.required_if' => 'من فضلك إختر نوع المقالات',
        ]);

        $widget->name = $request['widget_name'];
        $widget->type = $request['widget_type'];
        if ($request['widget_type'] == 'articles') {
            if ($request['widget_category_id'] != 0){
                $widget->category_id = $request['widget_category_id'];
            }else{
                $widget->category_id = null;
            }
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = $request['widget_query_type'];
            $widget->count = $request['widget_count'];
        }
        elseif ($request['widget_type'] == 'slider') {
            if ($request['widget_category_id'] != 0){
                $widget->category_id = $request['widget_category_id'];
            }else{
                $widget->category_id = null;
            }
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = $request['widget_query_type'];
            $widget->count = $request['widget_count'];
        }
        elseif ($request['widget_type'] == 'feature_article') {
            $widget->category_id = null;
            $widget->article_id = $request['widget_article_id'];
            $widget->ad_id = null;
            $widget->questionnaire_id = null;
            $widget->query_type = null;
            $widget->count = null;
        }
        elseif ($request['widget_type'] == 'questionnaire') {
            $widget->category_id = null;
            $widget->article_id = null;
            $widget->ad_id = null;
            $widget->questionnaire_id = $request['widget_questionnaire_id'];
            $widget->query_type = null;
            $widget->count = null;
        }
        else {
            $widget->category_id = null;
            $widget->article_id = null;
            $widget->ad_id = $request['widget_ad_id'];
            $widget->questionnaire_id = null;
            $widget->query_type = null;
            $widget->count = null;
        }

        $widget->number = $request['number'];
        $widget->status = $request['status'];

        if ($widget->update()) {

            session()->flash('Success', 'تم تعديل الودجت بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteWidget($WID)
    {
        $widget = Widget::find($WID);
        $FolderPath = base_path() . '/storage/app/widgets/' . $widget->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);


        if ($widget->delete()) {
            return Response::json($WID);
        } else {
            return Response::json("false");
        }
    }


    /*==================================================
                    Menus operations
    ====================================================*/


    public function getAllMenus()
    {
        $menus = Menu::orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Menus.Menus',
            [
                'PageTitle' => 'كل القوائم',
                'Active' => 'Menus',
                'menus' => $menus,
            ]);
    }


    public function getCreateMenu()
    {
        return view('AdminPanel.Menus.CreateMenu',
            [
                'PageTitle' => 'إضافه قائمه جديده',
                'Active' => 'Menus',
            ]);
    }


    public function postCreateMenu(Request $request)
    {
        $this->validate($request, [
            'menu_name' => 'required|string|max:70',
            'menu_position' => 'required',
        ]);

        $menu = new Menu();
        $menu->name = $request['menu_name'];
        $menu->position = $request['menu_position'];

        //get day, month and year for the session date
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $menu->day = $day;
        $menu->month = $month;
        $menu->year = $year;

        if ($menu->save()) {
            session()->flash('Success', 'تم إضافه القائمه بنجاح');
            return redirect('/AdminPanel/Menus/');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateMenu($MID)
    {
        $menu = Menu::find($MID);
        return view('AdminPanel.Menus.UpdateMenu',
            [
                'PageTitle' => $menu->name,
                'Active' => 'Menus',
                'menu' => $menu,
            ]);
    }


    public function postUpdateMenu($MID, Request $request)
    {
        $menu = Menu::find($MID);
        $this->validate($request, [
            'menu_name' => 'required|string|max:70',
            'menu_position' => 'required',
        ]);

        $menu->name = $request['menu_name'];
        $menu->position = $request['menu_position'];

        if ($menu->update()) {

            session()->flash('Success', 'تم تعديل القائمه بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteMenu($MID)
    {
        $menu = Menu::find($MID);
        $items = MenuItem::where('menu_id', '=', $menu->id)
            ->delete();
        if ($menu->delete()) {
            return Response::json($MID);
        } else {
            return Response::json("false");
        }
    }


    /*==================================================
                    Menu items operations
    ====================================================*/


    public function getMenuItems($MID)
    {
        $menu = Menu::find($MID);

        $items = MenuItem::where('menu_id', '=', $menu->id)
            ->where('item_id', '=', null)
            ->orderBy('id', 'desc')
            ->get();

        $selectItems = MenuItem::where('menu_id', '=', $menu->id)
            ->orderBy('id', 'desc')
            ->get();

        $select_parent = [];
        $select_parent[null] = 'إضافه كـ عنصر رئيسي';

        //if ($menu->position == 'header') {
            foreach ($selectItems as $item) {
                $select_parent[$item->id] = $item->name_ar;
            }
        //}

        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        $pages = StaticPage::orderBy('id', 'desc')->get();
        $select_page = [];
        foreach ($pages as $page) {
            $select_page[$page->id] = $page->nickName;
        }

        $articles = Article::where('status', '=', 'published')
            ->orderBy('id', 'desc')
            ->get();
        $select_article = [];
        foreach ($articles as $article) {
            $select_article[$article->id] = $article->name;
        }

        return view('AdminPanel.MenuItems.MenuItems',
            [
                'PageTitle' => $menu->name,
                'Active' => 'MenuItems',
                'menu' => $menu,
                'items' => $items,
                'select_page' => $select_page,
                'select_category' => $select_category,
                'select_article' => $select_article,
                'select_parent' => $select_parent,
            ]);
    }


    public function getCreateMenuItem($MID)
    {
        $menu = Menu::find($MID);
        return view('AdminPanel.MenuItems.CreateMenuItem',
            [
                'PageTitle' => 'إضافه عنصر جديد للقائمه',
                'Active' => 'MenuItems',
            ]);
    }


    public function postCreateMenuItem($MID, Request $request)
    {
        $menu = Menu::find($MID);
        $this->validate($request, [
            'item_type' => 'required',
            'item_name_ar' => 'nullable|required_if:item_type,=,external_link|string|max:70',
            'page_linked_id' => 'nullable|required_if:item_type,=,page',
            'category_linked_id' => 'nullable|required_if:item_type,=,category',
            'article_linked_id' => 'nullable|required_if:item_type,=,article',
            'external_link' => 'nullable|required_if:item_type,=,external_link',
            'item_parent_id' => 'nullable',
            'number' => 'nullable|numeric',
        ], [
            'item_name_ar.required_if' => 'من فضلك أدخل عنوان العنصر',
            'page_linked_id.required_if' => 'من فضلك إختر الصفحه',
            'category_linked_id.required_if' => 'من فضلك إختر القسم',
            'article_linked_id.required_if' => 'من فضلك إختر المقال',
            'external_link.required_if' => 'من فضلك أدخل الرابط',
        ]);

        $item = new MenuItem();
        $item->menu_id = $menu->id;
        $item->name_ar = $request['item_name_ar'];
        $item->name_en = $request['item_name_en'];
        $item->type = $request['item_type'];
        $item->item_id = $request['item_parent_id'];
        if ($request['item_type'] == 'page') {
            $item->linked_id = $request['page_linked_id'];
            if ($request['item_name_ar'] == '') {
                $page = StaticPage::find($request['page_linked_id']);
                $item->name = $page->nickName;
            }
        } elseif ($request['item_type'] == 'category') {
            $item->linked_id = $request['category_linked_id'];
            if ($request['item_name_ar'] == '') {
                $category = Category::find($request['category_linked_id']);
                $item->name = $category->name;
            }
        } elseif ($request['item_type'] == 'article') {
            $item->linked_id = $request['article_linked_id'];
            if ($request['item_name_ar'] == '') {
                $article = Article::find($request['article_linked_id']);
                $item->name = $article->name;
            }
        } elseif ($request['item_type'] == 'activities') {
        } elseif ($request['item_type'] == 'photos') {
        } elseif ($request['item_type'] == 'videos') {
        } elseif ($request['item_type'] == 'career') {
        } elseif ($request['item_type'] == 'consultancies') {
        } elseif ($request['item_type'] == 'about') {
        } elseif ($request['item_type'] == 'contact') {
        } else {
            $item->external_link = $request['external_link'];
        }
        $item->number = $request['number'];

        //get day, month and year for the session date
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $item->day = $day;
        $item->month = $month;
        $item->year = $year;

        if ($item->save()) {
            session()->flash('Success', 'تم إضافه العنصر بنجاح');
            return redirect('/AdminPanel/Menus/' . $item->menu_id . '/Items');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateMenuItem($MID, $IID)
    {
        $menu = Menu::find($MID);
        $item = MenuItem::where('menu_id', '=', $menu->id)
            ->where('id', '=', $IID)
            ->first();


        $items = MenuItem::where('menu_id', '=', $menu->id)
            ->orderBy('id', 'desc')
            ->get();

        $select_parent = [];
        $select_parent[null] = 'إضافه كـ عنصر رئيسي';
        foreach ($items as $ite) {
            $select_parent[$ite->id] = $ite->name_ar;
        }

        $categories = Category::where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        $pages = StaticPage::orderBy('id', 'desc')->get();
        $select_page = [];
        foreach ($pages as $page) {
            $select_page[$page->id] = $page->nickName;
        }

        $articles = Article::where('status', '=', 'published')
            ->orderBy('id', 'desc')
            ->get();
        $select_article = [];
        foreach ($articles as $article) {
            $select_article[$article->id] = $article->name;
        }


        return view('AdminPanel.MenuItems.UpdateMenuItem',
            [
                'PageTitle' => $menu->name,
                'Active' => 'MenuItems',
                'menu' => $menu,
                'item' => $item,
                'select_page' => $select_page,
                'select_category' => $select_category,
                'select_article' => $select_article,
                'select_parent' => $select_parent,
            ]);
    }


    public function postUpdateMenuItem($MID, $IID, Request $request)
    {
        $menu = Menu::find($MID);
        $item = MenuItem::where('menu_id', '=', $menu->id)
            ->where('id', '=', $IID)
            ->first();
        $this->validate($request, [
            'item_name_ar' => 'nullable|required_if:item_type,=,external_link|string|max:70',
            'item_type' => 'required',
            'page_linked_id' => 'nullable|required_if:item_type,=,page',
            'category_linked_id' => 'nullable|required_if:item_type,=,category',
            'article_linked_id' => 'nullable|required_if:item_type,=,article',
            'external_link' => 'nullable|required_if:item_type,=,external_link',
            'item_parent_id' => 'nullable',
            'number' => 'nullable|numeric',
        ], [
            'item_name_ar.required_if' => 'من فضلك أدخل عنوان العنصر',
            'page_linked_id.required_if' => 'من فضلك إختر الصفحه',
            'category_linked_id.required_if' => 'من فضلك إختر القسم',
            'article_linked_id.required_if' => 'من فضلك إختر المقال',
            'external_link.required_if' => 'من فضلك أدخل الرابط',
        ]);

        $item->name_ar = $request['item_name_ar'];
        $item->name_en = $request['item_name_en'];
        $item->type = $request['item_type'];
        $item->item_id = $request['item_parent_id'];
        if ($request['item_type'] == 'page') {
            $item->linked_id = $request['page_linked_id'];
            if ($request['item_name_ar'] == '') {
                $page = StaticPage::find($request['page_linked_id']);
                $item->name = $page->nickName;
            }
        } elseif ($request['item_type'] == 'category') {
            $item->linked_id = $request['category_linked_id'];
            if ($request['item_name_ar'] == '') {
                $category = Category::find($request['category_linked_id']);
                $item->name = $category->name;
            }
        } elseif ($request['item_type'] == 'article') {
            $item->linked_id = $request['article_linked_id'];
            if ($request['item_name_ar'] == '') {
                $article = Article::find($request['article_linked_id']);
                $item->name = $article->name;
            }
        } elseif ($request['item_type'] == 'activities') {
        } elseif ($request['item_type'] == 'photos') {
        } elseif ($request['item_type'] == 'videos') {
        } elseif ($request['item_type'] == 'career') {
        } elseif ($request['item_type'] == 'consultancies') {
        } elseif ($request['item_type'] == 'about') {
        } elseif ($request['item_type'] == 'contact') {
        } else {
            $item->external_link = $request['external_link'];
        }
        $item->number = $request['number'];

        if ($item->update()) {

            session()->flash('Success', 'تم تعديل العنصر بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteMenuItem($MID, $IID)
    {
        $menu = Menu::find($MID);
        $item = MenuItem::where('menu_id', '=', $menu->id)
            ->where('id', '=', $IID)
            ->first();
        if ($item->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }

    /*===============================================
                gallery operations
    =================================================*/


    public function getAllGalleryImages()
    {
        $images = Image::where('type', '=', 'gallery')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Gallery.GalleryImages',
            [
                'PageTitle' => 'معرض الصور',
                'Active' => 'Gallery',
                'images' => $images,
            ]);
    }


    public function getCreateGalleryImage()
    {
        return view('AdminPanel.Gallery.CreateGalleryImage',
            [
                'PageTitle' => 'صوره جديده',
                'Active' => 'Gallery',
            ]);
    }


    public function postCreateGalleryImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'nullable|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
            'number' => 'nullable|numeric',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->number = $request['number'];
        $image->type = 'gallery';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('gallery/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه الصوره بنجاح');
            return redirect('/AdminPanel/Gallery');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateGalleryImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.Gallery.UpdateGalleryImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'Gallery',
            ]);
    }


    public function postUpdateGalleryImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'nullable|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'number' => 'nullable|numeric',
        ]);

        $image->name = $request['image_name'];
        $image->number = $request['number'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/gallery/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('gallery/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل الصوره بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteGalleryImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/gallery/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                partner operations
    =================================================*/


    public function getAllPartnerImages()
    {
        $images = Image::where('type', '=', 'partner')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Partners.PartnerImages',
            [
                'PageTitle' => 'الشركاء',
                'Active' => 'Partners',
                'images' => $images,
            ]);
    }


    public function getCreatePartnerImage()
    {
        return view('AdminPanel.Partners.CreatePartnerImage',
            [
                'PageTitle' => 'شريك جديد',
                'Active' => 'Partners',
            ]);
    }


    public function postCreatePartnerImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل إسم الشريك',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->type = 'partner';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('partners/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه الشريك بنجاح');
            return redirect('/AdminPanel/Partners');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdatePartnerImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.Partners.UpdatePartnerImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'Partners',
            ]);
    }


    public function postUpdatePartnerImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل إسم الشريك',
        ]);

        $image->name = $request['image_name'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/partners/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('partners/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل الشريك بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeletePartnerImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/partners/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                organizer operations
    =================================================*/


    public function getAllOrganizerImages()
    {
        $images = Image::where('type', '=', 'organizer')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Organizers.OrganizersImages',
            [
                'PageTitle' => 'المنظمين الإداريين',
                'Active' => 'Organizers',
                'images' => $images,
            ]);
    }


    public function getCreateOrganizerImage()
    {
        return view('AdminPanel.Organizers.CreateOrganizerImage',
            [
                'PageTitle' => 'منظم إدارى جديد',
                'Active' => 'Organizers',
            ]);
    }


    public function postCreateOrganizerImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل إسم رابط',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->type = 'organizer';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('organizers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه البيانات بنجاح');
            return redirect('/AdminPanel/Organizers');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateOrganizerImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.organizers.UpdateOrganizerImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'Organizers',
            ]);
    }


    public function postUpdateOrganizerImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);

        $image->name = $request['image_name'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/organizers/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('organizers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل البيانات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteOrganizerImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/organizers/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                mediaorganizer operations
    =================================================*/


    public function getAllMediaOrganizerImages()
    {
        $images = Image::where('type', '=', 'mediaorganizer')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.MediaOrganizers.MediaOrganizersImages',
            [
                'PageTitle' => 'المنظمين الإعلاميين',
                'Active' => 'MediaOrganizers',
                'images' => $images,
            ]);
    }


    public function getCreateMediaOrganizerImage()
    {
        return view('AdminPanel.MediaOrganizers.CreateMediaOrganizerImage',
            [
                'PageTitle' => 'منظم إعلامى جديد',
                'Active' => 'MediaOrganizers',
            ]);
    }


    public function postCreateMediaOrganizerImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->type = 'mediaorganizer';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('mediaorganizers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه البيانات بنجاح');
            return redirect('/AdminPanel/MediaOrganizers');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateMediaOrganizerImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.MediaOrganizers.UpdateMediaOrganizerImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'MediaOrganizers',
            ]);
    }


    public function postUpdateMediaOrganizerImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);

        $image->name = $request['image_name'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/mediaorganizers/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('mediaorganizers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل البيانات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteMediaOrganizerImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/mediaorganizers/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                Center operations
    =================================================*/


    public function getAllCenterImages()
    {
        $images = Image::where('type', '=', 'Center')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Centers.CentersImages',
            [
                'PageTitle' => 'مراكز التدريب',
                'Active' => 'Centers',
                'images' => $images,
            ]);
    }


    public function getCreateCenterImage()
    {
        return view('AdminPanel.Centers.CreateCenterImage',
            [
                'PageTitle' => 'مركز تدريب جديد',
                'Active' => 'Centers',
            ]);
    }


    public function postCreateCenterImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->type = 'Center';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('Centers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه البيانات بنجاح');
            return redirect('/AdminPanel/Centers');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateCenterImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.Centers.UpdateCenterImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'Centers',
            ]);
    }


    public function postUpdateCenterImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);

        $image->name = $request['image_name'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/Centers/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('Centers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل البيانات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteCenterImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/Centers/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                Certificate operations
    =================================================*/


    public function getAllCertificateImages()
    {
        $images = Image::where('type', '=', 'Certificate')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Certificates.CertificatesImages',
            [
                'PageTitle' => 'الإعتمادات',
                'Active' => 'Certificates',
                'images' => $images,
            ]);
    }


    public function getCreateCertificateImage()
    {
        return view('AdminPanel.Certificates.CreateCertificateImage',
            [
                'PageTitle' => 'إعتماد جديد',
                'Active' => 'Certificates',
            ]);
    }


    public function postCreateCertificateImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->type = 'Certificate';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('Certificates/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه البيانات بنجاح');
            return redirect('/AdminPanel/Certificates');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateCertificateImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.Certificates.UpdateCertificateImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'Certificates',
            ]);
    }


    public function postUpdateCertificateImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);

        $image->name = $request['image_name'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/Certificates/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('Certificates/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل البيانات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteCertificateImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/Certificates/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                TeamMember operations
    =================================================*/


    public function getAllTeamMemberImages()
    {
        $images = Image::where('type', '=', 'TeamMember')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.TeamMembers.TeamMembersImages',
            [
                'PageTitle' => 'فريق العمل',
                'Active' => 'TeamMembers',
                'images' => $images,
            ]);
    }


    public function getCreateTeamMemberImage()
    {
        return view('AdminPanel.TeamMembers.CreateTeamMemberImage',
            [
                'PageTitle' => 'عضو جديد',
                'Active' => 'TeamMembers',
            ]);
    }


    public function postCreateTeamMemberImage(Request $request)
    {
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'required|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);
        $image = new Image();
        $image->name = $request['image_name'];
        $image->des = $request['image_des'];
        $image->type = 'TeamMember';
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $image->day = $day;
        $image->month = $month;
        $image->year = $year;
        if ($image->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('TeamMembers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم إضافه البيانات بنجاح');
            return redirect('/AdminPanel/TeamMembers');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateTeamMemberImage($IID)
    {
        $image = Image::find($IID);
        return view('AdminPanel.TeamMembers.UpdateTeamMemberImage',
            [
                'PageTitle' => $image->name,
                'image' => $image,
                'Active' => 'TeamMembers',
            ]);
    }


    public function postUpdateTeamMemberImage($IID, Request $request)
    {
        $image = Image::find($IID);
        $this->validate($request, [
            'image_name' => 'required|string|max:80',
            'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif',
        ], [
            'image_name.required' => 'من فضلك أدخل رابط',
        ]);

        $image->name = $request['image_name'];
        $image->des = $request['image_des'];

        if ($image->update()) {

            if ($request->hasFile('image_file')) {
                $file_path = base_path() . '/storage/app/TeamMembers/' . $image->id . '/' . $image->file;
                File::delete($file_path);

                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $image->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('TeamMembers/' . $image->id, $NewFileName);
                $image->file = $NewFileName;
                $image->update();

                $originalName = $file->getClientOriginalName();
                if ($image->name == '') {
                    $image->name = pathinfo($originalName, PATHINFO_FILENAME);
                    $image->update();
                }
            }
            session()->flash('Success', 'تم تعديل البيانات بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteTeamMemberImage($IID)
    {
        $image = Image::find($IID);
        $FolderPath = base_path() . '/storage/app/TeamMembers/' . $image->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($image->delete()) {
            return Response::json($IID);
        } else {
            return Response::json("false");
        }
    }


    /*===============================================
                    quotes operations
    =================================================*/


    public function getAllQuotes()
    {
        $quotes = Quote::orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Quotes.Quotes',
            [
                'PageTitle' => 'آراء الأعضاء فى الأكاديمية',
                'Active' => 'Quotes',
                'quotes' => $quotes,
            ]);
    }


    public function getCreateQuote()
    {
        return view('AdminPanel.Quotes.CreateQuote',
            [
                'PageTitle' => ' رأي جديد',
                'Active' => 'Quotes',
            ]);
    }


    public function postCreateQuote(Request $request)
    {
        $this->validate($request, [
            'quote_content' => 'required',
            'uName' => 'nullable|string|max:80',
            'uJobTitle' => 'nullable|string|max:180',
        ]);

        $quote = New Quote();
        $quote->content = $request['quote_content'];
        $quote->name = $request['uName'];
        $quote->jobTitle = $request['uJobTitle'];
        $quote->isAccepted = 1;
        $quote->status = 'read';

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $quote->day = $day;
        $quote->month = $month;
        $quote->year = $year;

        if ($quote->save()) {
            if ($request->hasFile('image_file')) {
                $file = $request['image_file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $quote->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('Quotes/' . $quote->id, $NewFileName);
                $quote->file = $NewFileName;
                $quote->update();
            }

            session()->flash('Success', 'تم إضافه رأي العضو بنجاح');
            return redirect('/AdminPanel/Quotes');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateQuote($QID)
    {
        $quote = Quote::find($QID);
        $quote->status = 'read';
        $quote->update();
        return view('AdminPanel.Quotes.UpdateQuote',
            [
                'PageTitle' => 'تعديل رأي عضو',
                'quote' => $quote,
                'Active' => 'Quotes',
            ]);
    }


    public function postUpdateQuote($QID, Request $request)
    {
        $quote = Quote::find($QID);
        $this->validate($request, [
            'quote_content' => 'required|max:250',
            'uName' => 'nullable|string|max:80',
            'uJobTitle' => 'nullable|string|max:180',
        ]);
        $quote->content = $request['quote_content'];
        $quote->isAccepted = $request['isAccepted'];
        $quote->name = $request['uName'];
        $quote->jobTitle = $request['uJobTitle'];
        if ($quote->update()) {
            session()->flash('Success', 'تم تعديل رأي العضو بنجاح');
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteQuote($QID)
    {
        $quote = Quote::find($QID);
        $quoteNotifications = Notification::where('type', '=', 'quote')
            ->where('linked_id', '=', $quote->id)
            ->get();
        foreach ($quoteNotifications as $quoteNotification) {
            $quoteNotification->delete();
        }
        if ($quote->delete()) {
            return Response::json($QID);
        } else {
            return Response::json("false");
        }
    }


    public function getAllTranslationRequests()
    {
        $forms = TranslateRequest::orderBy('id', 'desc')->get();
        return view('AdminPanel.TranslationRequests.TranslationRequests',
            [
                'PageTitle' => 'إداره طلبات الترجمه',
                'forms' => $forms,
                'Active' => 'TranslationRequests',
            ]);
    }


    public function getUpdateTranslationRequest($TID)
    {
        $form = TranslateRequest::find($TID);
        $form->status = 'read';
        $form->update();
        return view('AdminPanel.TranslationRequests.UpdateTranslationRequest',
            [
                'PageTitle' => 'تفاصيل الطلب',
                'form' => $form,
                'Active' => 'TranslationRequests',
            ]);
    }

    public function postUpdateTranslationRequest($TID, Request $request)
    {
        $form = TranslateRequest::find($TID);
        $form->phoned = $request['phoned'];
        $form->notes = $request['notes'];
        $form->update();
        return view('AdminPanel.TranslationRequests.UpdateTranslationRequest',
            [
                'PageTitle' => 'تفاصيل الطلب',
                'form' => $form,
                'Active' => 'TranslationRequests',
            ]);
    }


    public function DeleteTranslationRequest($TID)
    {
        $form = TranslateRequest::find($TID);
        $notifications = Notification::where('type', '=', 'translation')
            ->where('linked_id', '=', $TID)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
        $FolderPath = base_path() . '/storage/app/translation/' . $form->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($form->delete()) {
            return Response::json($TID);
        } else {
            return Response::json("false");
        }
    }

}
