<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Article;
use App\Category;
use App\Questionnaire;
use App\QuestionnaireVote;
use App\StaticPage;
use App\Visit;
use App\Image;
use App\Videos;
use App\Applications;
use App\Setting;
use App\Services;
use App\User;
use App\UserRole;
use App\Mail\NotificationEmail;
use App\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Response;

class FrontEndController extends Controller
{
    //
    public function getHome()
    {
        $featureCategories = Category::where('isFeature', '=', 1)
            ->where('status', '=', 'published')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->take(6)->get();

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $session_id = Session::getId();

        // check if the visitor doesn't visit this page in the current session
        if (!Visit::where('session_id', '=', $session_id)
            ->where('linked_id', '=', null)
            ->where('type', '=', 'home')
            ->where('day', '=', $day)
            ->where('month', '=', $month)
            ->where('year', '=', $year)
            ->exists()) {
            $visit = new Visit();
            $visit->session_id = $session_id;
            $visit->ip_address = $_SERVER['REMOTE_ADDR'];
            $visit->linked_id = null;
            $visit->type = 'home';
            $visit->day = $day;
            $visit->month = $month;
            $visit->year = $year;
            $visit->save();
        }
        
        return view('FrontEnd.Home',
            [
                'PageTitle' => trans('Site.SiteHomePage'),
                'Active' => 'Index',
                'featureCategories' => $featureCategories,
            ]);
    }
    
    public function Questionnaire()
    {
        $questionnaires = Questionnaire::where('status', '=', 'active')
                                        ->where('publishTime', '<=', strtotime('now'))
                                        ->where('expireTime', '>=', strtotime('now'))
                                        ->orderBy('id', 'desc')->get();

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $session_id = Session::getId();

        // check if the visitor doesn't visit this page in the current session
        if (!Visit::where('session_id', '=', $session_id)
            ->where('linked_id', '=', null)
            ->where('type', '=', 'Questionnaire')
            ->where('day', '=', $day)
            ->where('month', '=', $month)
            ->where('year', '=', $year)
            ->exists()) {
            $visit = new Visit();
            $visit->session_id = $session_id;
            $visit->ip_address = $_SERVER['REMOTE_ADDR'];
            $visit->linked_id = null;
            $visit->type = 'Questionnaire';
            $visit->day = $day;
            $visit->month = $month;
            $visit->year = $year;
            $visit->save();

        }
        $seo_img = '';

        return view('FrontEnd.DynamicPages.Questionnaire')->with([
            'questionnaires' => $questionnaires,
            'PageTitle' => 'استفتاءات الأفضل',
            'Active' => 'Questionnaire',
            'seo_title' => 'استفتاءات الأفضل',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => $seo_img,
        ]);
    }


    public function getCategoryArticles($CID, $CSlug)
    {
        $category = Category::where('id', '=', $CID)
            ->where('slug', '=', $CSlug)
            ->where('status', '=', 'published')
            ->first();

        if ($category != '') {
            if($category->category_id == ''){
                $articles = Article::where('category_id', '=', $category->id)
                    ->where('status', '=', 'published')
                    ->paginate(14);

            }else{
                $cateIDs = [];
                array_push($cateIDs, $category->id);
                $parents = Category::where('category_id', '=', $category->id)
                    ->get()->pluck('id')->toArray();
                if (count($parents) != 0) {
                    array_push($cateIDs, $parents);
                }
                $articles = Article::whereIn('category_id',  $cateIDs)
                    ->where('status', '=', 'published')
                    ->paginate(14);
            }

            //get day, month and year for the session date
            $day = date("d");
            $month = date("m");
            $year = date("Y");
            $session_id = Session::getId();

            // check if the visitor doesn't visit this page in the current session
            if (!Visit::where('session_id', '=', $session_id)
                ->where('linked_id', '=', $category->id)
                ->where('type', '=', 'category')
                ->where('day', '=', $day)
                ->where('month', '=', $month)
                ->where('year', '=', $year)
                ->exists()) {
                $visit = new Visit();
                $visit->session_id = $session_id;
                $visit->ip_address = $_SERVER['REMOTE_ADDR'];
                $visit->linked_id = $category->id;
                $visit->type = 'category';
                $visit->day = $day;
                $visit->month = $month;
                $visit->year = $year;
                $visit->save();

                $category->visits = $category->visits + 1;
                $category->update();
            }

            if ($category->seo_image != null) {
                $seo_img = 'storage/app/categories/' . $category->id . '/' . $category->seo_image;
            } else {
                $seo_img = '';
            }

            return view('FrontEnd.Articles.Articles',
                [
                    'PageTitle' => $category->name,
                    'Active' => 'Articles',
                    'category' => $category,
                    'articles' => $articles,
                    'seo_title' => $category->seo_title,
                    'seo_description' => $category->seo_description,
                    'seo_keywords' => $category->seo_keywords,
                    'seo_image' => $seo_img,
                ]);

        } else {
            session()->put('Faild', trans('alert.invalid'));
            if (url()->previous() != '') {
                return back();
            } else {
                return redirect('/');
            }
        }
    }


    public function getSingleArticle($CID, $AID, $ASlug)
    {
        $category = Category::where('id', '=', $CID)
            ->where('status', '=', 'published')
            ->first();

        if ($category != '') {
            $article = Article::where('id', '=',$AID)
                ->where('slug', '=',$ASlug)
                ->where('category_id', '=', $category->id)
                ->where('status', '=', 'published')
                ->first();

        } else {
            $article = '';
        }

        if ($article != '') {
            $relatedArticles = Article::where('category_id', '=', $category->id)
                ->where('id', '!=', $article->id)
                ->where('status', '=', 'published')
                ->orderByRaw('RAND()')
                ->take(3)->get();

            //get day, month and year for the session date
            $day = date("d");
            $month = date("m");
            $year = date("Y");
            $session_id = Session::getId();

            // check if the visitor doesn't visit this page in the current session
            if (!Visit::where('session_id', '=', $session_id)
                ->where('linked_id', '=', $article->id)
                ->where('type', '=', 'article')
                ->where('day', '=', $day)
                ->where('month', '=', $month)
                ->where('year', '=', $year)
                ->exists()) {
                $visit = new Visit();
                $visit->session_id = $session_id;
                $visit->ip_address = $_SERVER['REMOTE_ADDR'];
                $visit->linked_id = $article->id;
                $visit->type = 'article';
                $visit->day = $day;
                $visit->month = $month;
                $visit->year = $year;
                $visit->save();

                $article->visits = $article->visits + 1;
                $article->update();
            }
            if ($article->seo_image != null) {
                $seo_img = 'storage/app/articles/' . $article->id . '/' . $article->seo_image;
            } else {
                $seo_img = '';
            }

            return view('FrontEnd.Articles.SingleArticle',
                [
                    'PageTitle' => $article->name,
                    'Active' => 'Articles',
                    'category' => $category,
                    'article' => $article,
                    'seo_title' => $article->seo_title,
                    'seo_description' => $article->seo_description,
                    'seo_keywords' => $article->seo_keywords,
                    'seo_image' => $seo_img,
                    'relatedArticles' => $relatedArticles,
                ]);
        } else {
            session()->put('Faild', trans('alert.invalid'));
            if (url()->previous() != '') {
                return back();
            } else {
                return redirect('/');
            }
        }
    }


    public function getStaticPages($PID, $PSlug)
    {
        $page = StaticPage::where('id', '=', $PID)
            ->where('slug', '=', $PSlug)
            ->first();

        //get day, month and year for the session date
        date_default_timezone_set('Africa/Cairo');
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $session_id = Session::getId();

        // check if the visitor doesn't visit this page in the current session
        if (!Visit::where('session_id', '=', $session_id)
            ->where('linked_id', '=', $page->id)
            ->where('type', '=', 'page')
            ->where('day', '=', $day)
            ->where('month', '=', $month)
            ->where('year', '=', $year)
            ->exists()) {
            $visit = new Visit();
            $visit->session_id = $session_id;
            $visit->ip_address = $_SERVER['REMOTE_ADDR'];
            $visit->linked_id = $page->id;
            $visit->type = 'page';
            $visit->day = $day;
            $visit->month = $month;
            $visit->year = $year;
            $visit->save();

            $page->visits = $page->visits + 1;
            $page->update();
        }

        if ($page->seo_image != null) {
            $seo_img = 'storage/app/pages/' . $page->id . '/' . $page->seo_image;
        } else {
            $seo_img = '';
        }

        return view('FrontEnd.DynamicPages.SinglePage')->with([
            'page' => $page,
            'PageTitle' => $page->nickName,
            'Active' => 'Page' . $page->id,
            'seo_title' => $page->seo_title,
            'seo_description' => $page->seo_description,
            'seo_keywords' => $page->seo_keywords,
            'seo_image' => $seo_img,
        ]);
    }

    public function getAboutPage()
    {

        return view('FrontEnd.DynamicPages.AboutPage')->with([
            'Active' => 'about',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getPhotosPage()
    {
        $images = Image::where('type', '=', 'gallery')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('FrontEnd.DynamicPages.PhotosPage')->with([
            'Active' => 'Photos',
            'Photos' => $images,
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getVideosPage()
    {
        $Videos = Videos::orderBy('Ordered','asc')->paginate(9);
        return view('FrontEnd.DynamicPages.VideosPage')->with([
            'Active' => 'Vidoes',
            'Videos' => $Videos,
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getConsultanciesPage()
    {
        $images = Image::where('type', '=', 'partner')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('FrontEnd.DynamicPages.ConsultanciesPage')->with([
            'Active' => 'Consultancies',
            'Photos' => $images,
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getCareerPage()
    {

        return view('FrontEnd.DynamicPages.CareerPage')->with([
            'Active' => 'about',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function postCareerPage()
    {

        return view('FrontEnd.DynamicPages.CareerPage')->with([
            'Active' => 'about',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getContactPage()
    {

        return view('FrontEnd.DynamicPages.ContactPage')->with([
            'Active' => 'contactus',
            'seo_title' => trans('Site.ContactUs'),
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => ''
        ]);
    }

    public function getAllCources()
    {
        return view('FrontEnd.DynamicPages.AllCources')->with([
            'Active' => 'courses',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getSingleCource($CateID,$CourceID,$ASlug)
    {
        $Course = Services::find($CourceID);
        return view('FrontEnd.DynamicPages.CourseDetails',[
            'Active' => 'courses',
            'Course' => $Course,
            'seo_title' => $Course['Title_'.session()->get('Lang')],
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }
    
    public function postSingleCource(Request $request)
    {
        $this->validate($request, [
            'PersonName' => 'required|string|min:2|max:255',
            'Email' => 'nullable|email',
            'Phone' => 'required|numeric|regex:/[0-9]{10}/',
            'CompanyName' => 'required|min:2',

        ]);

        $attend = new Applications();
        $attend->PersonName    = $request['PersonName'];
        $attend->CompanyName   = $request['CompanyName'];
        $attend->Title         = $request['Title'];
        $attend->Email         = $request['Email'];
        $attend->Address       = $request['Address'];
        $attend->Phone         = $request['Phone'];
        $attend->Mobile        = $request['Mobile'];
        $attend->msg           = $request['msg'];
        $attend->Type          = $request['CourseID'];
        $attend->Status        = 'Unread';

        if ($attend->save()) {
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
                    if($attend->CompanyName == 'Person'):
                        $notification->type = 'PersonalTraining';
                    else:
                        $notification->type = 'CompaniesTraining';
                    endif;
                    $notification->linked_id = $attend->id;
                    $notification->content =
                        ' قام '
                        . $attend->PersonName
                        . ' بإرسال طلب اشتراك من خلال الموقع ';
                    $notification->sendto = 'admin';
                    $notification->save();
                    /*if ($setting['notification_status']->value == 'both'
                        && $setting['notification_email']->value != ''
                        && $mail == 0) {
                            
                        Mail::to($setting['notification_email']->value)->send(new NotificationEmail($notification));
                        $mail = 1;
                    }*/
                }
            }

            session()->put('Success', trans('alert.messageSentOk'));
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }

    public function getAllParteners($Type)
    {
        if ($Type == 'Clients') {
            $Type = 'partner';
        }
        $Gallery = Image::where('type', '=', $Type)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('FrontEnd.DynamicPages.AllParteners')->with([
            'Active' => 'courses',
            'Gallery' => $Gallery,
            'Type' => $Type,
            'seo_title' => 'شركاء النجاح',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function getRegisteration($Type)
    {
        return view('FrontEnd.DynamicPages.Registeration',[
            'Active' => 'courses',
            'Type' => $Type,
            'seo_title' => 'تسجيل البيانات',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }
    
    public function postRegisteration($Type,Request $request)
    {
        $this->validate($request, [
            'PersonName' => 'required|string|min:2|max:255',
            'Email' => 'nullable|email',
            'Phone' => 'required|numeric|regex:/[0-9]{10}/',
            'CompanyName' => 'required|min:2',

        ]);

        $attend = new Applications();
        $attend->PersonName    = $request['PersonName'];
        $attend->CompanyName   = $request['CompanyName'];
        $attend->Title         = $request['Title'];
        $attend->Email         = $request['Email'];
        $attend->Address       = $request['Address'];
        $attend->Phone         = $request['Phone'];
        $attend->Mobile        = $request['Mobile'];
        $attend->msg           = $request['msg'];
        $attend->Type          = $Type;
        $attend->Status        = 'Unread';

        if ($attend->save()) {
            $setting = Setting::get()->keyBy('key')->all();

            if (isset($request['file'])) {
                $file = $request['file'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $attend->id . '_' . rand(1, 999999) . '.' . $FileExt;
                $file->storeAs('aplications/' . $attend->id, $NewFileName);
                $attend->file = $NewFileName;
                $attend->update();
            }
            // send notification to admin
            $userAdmins = UserRole::where('role_id', '=', 1)->get()->pluck('user_id')->toArray();
            $admins = User::whereIn('id', $userAdmins)->get();
            if (count($admins) != 0) {
                $mail = 0;
                foreach ($admins as $admin) {
                    $notification = new Notification();
                    $notification->user_id = null;
                    $notification->receiver_id = $admin->id;
                    $notification->type = $Type;
                    $notification->linked_id = $attend->id;
                    $notification->content =
                        ' قام '
                        . $attend->PersonName
                        . ' بإرسال طلب اشتراك من خلال الموقع ';
                    $notification->sendto = 'admin';
                    $notification->save();
                    /*if ($setting['notification_status']->value == 'both'
                        && $setting['notification_email']->value != ''
                        && $mail == 0) {
                            
                        Mail::to($setting['notification_email']->value)->send(new NotificationEmail($notification));
                        $mail = 1;
                    }*/
                }
            }

            session()->put('Success', trans('alert.messageSentOk'));
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }

    public function postBookStandPage(Request $request)
    {
        $this->validate($request, [
            'PersonName' => 'required|string|min:2|max:255',
            'Email' => 'required|email',
            'Phone' => 'nullable|numeric|regex:/[0-9]{7}/',
            'CompanyName' => 'required|min:2',

        ]);

        $bookstand = new Applications();
        $bookstand->PersonName    = $request['PersonName'];
        $bookstand->CompanyName   = $request['CompanyName'];
        $bookstand->Title         = $request['Title'];
        $bookstand->Activity      = $request['Activity'];
        $bookstand->Email         = $request['Email'];
        $bookstand->SQM           = $request['SQM'];
        $bookstand->Phone         = $request['Phone'];
        $bookstand->WebSite       = $request['WebSite'];
        $bookstand->Country        = $request['Country'];
        $bookstand->msg           = $request['msg'];
        $bookstand->Type          = 'bookstand';
        $bookstand->Status        = 'Unread';

        if ($bookstand->save()) {
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
                    $notification->type = 'bookstand';
                    $notification->linked_id = $bookstand->id;
                    $notification->content =
                        ' قام '
                        . $bookstand->PersonName
                        . ' بإرسال طلب حجز ستاند من خلال الموقع ';
                    $notification->sendto = 'admin';
                    $notification->save();
                    /*if ($setting['notification_status']->value == 'both'
                        && $setting['notification_email']->value != ''
                        && $mail == 0) {
                            
                        Mail::to($setting['notification_email']->value)->send(new NotificationEmail($notification));
                        $mail = 1;
                    }*/
                }
            }

            session()->put('Success', trans('alert.messageSentOk'));
            return back();
        } else {
            session()->flash('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getBeSponsorPage()
    {

        return view('FrontEnd.DynamicPages.BeSponsorPage')->with([
            'Active' => 'about',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
            'seo_image' => '',
        ]);
    }

    public function postQuestionnaireVote($QID, Request $request)
    {
        $questionnaire = Questionnaire::find($QID);
        $session_id = Session::getId();

        if (QuestionnaireVote::where('session_id', '=', $session_id)
            ->where('questionnaire_id', '=', $questionnaire->id)->exists()) {
            $vote = QuestionnaireVote::where('session_id', '=', $session_id)
                ->where('questionnaire_id', '=', $questionnaire->id)->first();
            $vote->value = $request['vote'];
            if ($vote->update()) {
                return back();
            }
        } else {
            $vote = new QuestionnaireVote();
            $vote->value = $request['vote'];
            $vote->session_id = $session_id;
            $vote->questionnaire_id = $questionnaire->id;

            if ($vote->save()) {
                return back();
            }
        }
    }


    public function getSearch(Request $request)
    {
        return redirect('/SearchResults/' . $request['keyword'] );
    }


    public function getSearchResults($keyword)
    {
        $categories = Category::where('status', '=', 'published')
            ->get()->pluck('id')->toArray();

        $keys = explode(" ", $keyword);
        $articles = Article::where(function ($q) use ($keys) {
            foreach ($keys as $key) {
                $q->where('name', 'like', "%$key%");
                $q->orWhere('summary', 'like', "%$key%");
                $q->orWhere('description', 'like', "%$key%");
            }
        })->whereIn('category_id', $categories)
            ->where('status', '=', 'published')
            ->orderBy('id', 'desc')->paginate(14);

        return view('FrontEnd.Articles.Articles',
            [
                'PageTitle' => 'نتائج البحث',
                'Active' => 'Articles',
                'articles' => $articles,
                ]);
    }



    public function getVisitAd($AID)
    {
        $ad = Ad::find($AID);
        $ad->visits=$ad->visits+1;
        $ad->update();
        return redirect($ad->link);
    }

}
