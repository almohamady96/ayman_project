<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Response;

class SupervisorController extends Controller
{
    //
    public function SupervisorIndex()
    {
        return view('SupervisorPanel.index',
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

        return view('SupervisorPanel.Profile.UpdateProfile',
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
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        $categories = Category::whereIn('id', $adminCategories)
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        return view('SupervisorPanel.Categories.Categories',
            [
                'PageTitle' => 'إدارة الأقسام',
                'Active' => 'Categories',
                'categories' => $categories,
            ]);
    }


    public function getUpdateCategory($CID)
    {
        $category = Category::find($CID);
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        if (in_array($category->id, $adminCategories)) {
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
            return view('SupervisorPanel.Categories.UpdateCategory',
                [
                    'PageTitle' => $category->name,
                    'Active' => 'Categories',
                    'category' => $category,
                    'select_category' => $select_category,
                ]);
        } else {
            return redirect('/error');
        }
    }


    public function postUpdateCategory($CID, Request $request)
    {
        $category = Category::find($CID);

        $this->validate($request, [
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable',
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
        $category->name = $request['category_name'];
        $category->description = $request['category_description'];
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
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        $articles = Article::whereIn('category_id', $adminCategories)
            ->orderBy('id', 'desc')
            ->get();
        return view('SupervisorPanel.Articles.Articles',
            [
                'PageTitle' => 'كل المقالات',
                'Active' => 'Articles',
                'articles' => $articles,
            ]);
    }


    public function getCreateArticle()
    {
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        $categories = Category::whereIn('category_id', $adminCategories)
            ->where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $select_category = [];
        foreach ($categories as $cate) {
            $select_category[$cate->id] = $cate->name;
        }

        return view('SupervisorPanel.Articles.CreateArticle',
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
            'article_name' => 'required|max:180',
            'article_summary' => 'nullable|max:670',
            'article_description' => 'required',
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
        $article->name = $request['article_name'];
        $article->summary = $request['article_summary'];
        $article->description = $request['article_description'];
        /*$article->isFeature = $request['article_isFeature'];
        $article->isFeatureTime = strtotime('now');*/

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
        $article->seo_description = $request['seo_description'];

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
            return redirect('/SupervisorPanel/Categories/' . $article->category_id . '/Articles');
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateArticle($PID)
    {
        $article = Article::find($PID);

        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        if (in_array($article->category_id, $adminCategories)) {

            $categories = Category::whereIn('id', $adminCategories)
                ->orderBy('number', 'asc')
                ->orderBy('id', 'desc')->get();
            $select_category = [];
            foreach ($categories as $cate) {
                if ($cate->status == 'published') {
                    $status = '';
                } else {
                    $status = ' ( مؤرشف حالياً ) ';
                }
                $select_category[$cate->id] = $cate->name . $status;
            }


            return view('SupervisorPanel.Articles.UpdateArticle',
                [
                    'PageTitle' => $article->name,
                    'Active' => 'Articles',
                    'select_category' => $select_category,
                    'article' => $article,
                ]);
        } else {
            return redirect('/error');
        }
    }


    public function postUpdateArticle($PID, Request $request)
    {
        $article = Article::find($PID);
        $this->validate($request, [
            'category_id' => 'required',
            'article_author' => 'nullable|max:180',
            'article_name' => 'required|max:180',
            'article_summary' => 'nullable|max:670',
            'article_description' => 'required',
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
        $article->name = $request['article_name'];
        $article->summary = $request['article_summary'];
        $article->description = $request['article_description'];
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
        $article->seo_description = $request['seo_description'];

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

    /*==================================================
               category courses operations
    ====================================================*/


    public function getCategoryArticles($CID)
    {
        $category = Category::find($CID);
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        if (in_array($category->id, $adminCategories)) {

            $articles = Article::where('category_id', '=', $category->id)
                ->orderBy('id', 'desc')
                ->get();
            return view('SupervisorPanel.Articles.Articles',
                [
                    'PageTitle' => $category->name,
                    'Active' => 'Categories',
                    'category' => $category,
                    'articles' => $articles,
                ]);
        } else {
            return redirect('/error');
        }
    }

    public function getCreateCategoryArticle($CID)
    {
        $category = Category::find($CID);

        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        if (in_array($category->id, $adminCategories)) {
            $categories = Category::whereIn('id', $adminCategories)
                ->where('status', '=', 'published')
                ->orderBy('number', 'asc')
                ->orderBy('id', 'desc')
                ->get();
            $select_category = [];
            foreach ($categories as $cate) {
                $select_category[$cate->id] = $cate->name;
            }

            return view('SupervisorPanel.Articles.CreateArticle',
                [
                    'PageTitle' => 'إضافه مقال جديد',
                    'Active' => 'Categories',
                    'select_category' => $select_category,
                    'category' => $category,
                ]);
        } else {
            return redirect('/error');
        }
    }


    public function getUpdateCategoryArticle($CateID, $PID)
    {

        $category = Category::find($CateID);
        $article = Article::where('id', '=', $PID)
            ->where('category_id', '=', $category->id)
            ->first();
        if (Auth::user()->categories != '') {
            $adminCategories = unserialize(base64_decode(Auth::user()->categories));
        } else {
            $adminCategories = [];
        }

        if (in_array($category->id, $adminCategories)) {
            $categories = Category::whereIn('id', $adminCategories)
                ->orderBy('number', 'asc')
                ->orderBy('id', 'desc')->get();
            $select_category = [];
            foreach ($categories as $cate) {
                if ($cate->status == 'published') {
                    $status = '';
                } else {
                    $status = ' ( مؤرشف حالياً ) ';
                }
                $select_category[$cate->id] = $cate->name . $status;
            }


            return view('SupervisorPanel.Articles.UpdateArticle',
                [
                    'PageTitle' => $article->name,
                    'article' => $article,
                    'category' => $category,
                    'Active' => 'Categories',
                    'select_category' => $select_category,
                ]);
        } else {
            return redirect('/error');
        }
    }

}
