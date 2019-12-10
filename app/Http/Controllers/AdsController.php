<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\StaticPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Response;

class AdsController extends Controller
{
    //

    /*============================================
                        backend
    =============================================*/

    public function autoStopAds()
    {
        $today = strtotime('now');

        $ads = Ad::where('status', '=', 'active')->get();
        foreach ($ads as $ad) {
            if ($today > $ad->expireTime) {
                $ad->status = 'inactive';
                $ad->update();
            }
        }
    }


    public function getAllAds()
    {
        $ads = Ad::orderBy('number', 'asc')
            ->orderBy('id', 'desc')->get();
        return view('AdminPanel.Ads.Ads',
            [
                'PageTitle' => 'كل الإعلانات',
                'Active' => 'AllAds',
                'ads' => $ads,
            ]);
    }


    public function ActiveAds()
    {
        $ads = Ad::where('status', '=', 'active')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Ads.Ads',
            [
                'PageTitle' => 'الإعلانات النشطه',
                'Active' => 'ActiveAds',
                'ads' => $ads,
            ]);
    }

    public function getInactiveAds()
    {
        $ads = Ad::where('status', '=', 'inactive')
            ->orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return view('AdminPanel.Ads.Ads',
            [
                'PageTitle' => 'الإعلانات الغير نشطه',
                'Active' => 'InactiveAds',
                'ads' => $ads,
            ]);
    }

    public function getCreateAd()
    {
        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_category[$cate->id] = $cate->name . $status;
        }


        $home_ads = [
            'slider' => 'بجانب الإسلايدر في الصفحه الرئيسيه " أفضل مقاس 350 * 300 " ',
            'news1' => 'أسفل المربع الإخباري الأول " أفضل مقاس 728 * 90 " ',
            'news2' => 'أسفل المربع الإخباري الثاني " أفضل مقاس 728 * 90 " ',
            'news3' => 'أسفل المربع الإخباري الثالث " أفضل مقاس 728 * 90 " ',
            'news4' => 'أسفل المربع الإخباري الرابع " أفضل مقاس 728 * 90 " ',
            'news5' => 'أسفل المربع الإخباري الخامس " أفضل مقاس 728 * 90 " ',
            'footer' => 'آخر الصفحه " أفضل مقاس 350 * 900 " ',
        ];

        return view('AdminPanel.Ads.CreateAd',
            [
                'PageTitle' => ' إعلان جديد',
                'Active' => 'AllAds',
                'select_category' => $select_category,
                'home_ads' => $home_ads,
            ]);
    }


    public function postCreateAd(Request $request)
    {
        $this->validate($request, [
            'ad_name' => 'nullable|required_if:ad_code,=,""|string|max:80',
            'ad_type' => 'required',
            'ad_category_id' => 'nullable',
            'ad_position' => 'nullable',
            'ad_publishDate' => 'required|date',
            'ad_expireDate' => 'required|date|after:ad_publishDate',
            'ad_link' => 'nullable|url|required_if:ad_code,=,""',
            'ad_image' => 'nullable|file|mimes:jpeg,jpg,png,gif|required_unless:ad_link,=,""',
            'ad_code' => 'nullable|required_if:ad_link,=,""',
            'number' => 'nullable|numeric',
        ], [
            'ad_name.required_if' => 'من فضلك أدخل عنوان الإعلان',
            'ad_image.required_unless' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
            'ad_link.required_if' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
            'ad_code.required_if' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
        ]);

        if (strtotime($request['ad_publishDate'] < strtotime('now'))) {
            session()->flash('Faild', 'عفواً تاريخ نشر الإعلان يجب أن يكون أكبر من الوقت الحالي');
            return back()->withInput();
        }
        $ad = New Ad();
        $ad->name = $request['ad_name'];
        $ad->type = $request['ad_type'];

        if($request['ad_type'] == 'popup' && $request['ad_code'] != ''){
            session()->flash('Faild', 'عفواً كود الإعلان لا يمكن إضافته كإعلان منبثق');
            return back()->withInput();

        }

        $ad->category_id = $request['ad_category_id'];
        $ad->position = $request['ad_position'];
        $ad->publishDate = $request['ad_publishDate'];
        $ad->publishTime = strtotime($request['ad_publishDate']);
        $ad->expireDate = $request['ad_expireDate'];
        $ad->expireTime = strtotime($request['ad_expireDate']);
        $ad->link = $request['ad_link'];
        $ad->code = $request['ad_code'];
        $ad->number = $request['number'];

        //get day, month and year for the session date
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $ad->day = $day;
        $ad->month = $month;
        $ad->year = $year;


        if ($ad->save()) {
            if ($request->hasFile('ad_image')) {
                $file = $request['ad_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $ad->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('ads/' . $ad->id, $NewFileName);
                $ad->image = $NewFileName;
                $ad->update();
            }

            session()->put('Success', 'تم إضافه الإعلان بنجاح');
            return redirect('/AdminPanel/Ads');
        } else {
            session()->put('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function getUpdateAd($AdID)
    {
        $ad = Ad::find($AdID);
        $categories = Category::orderBy('number', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($categories as $cate) {
            if ($cate->status == 'published') {
                $status = '';
            } else {
                $status = ' ( مؤرشف حالياً ) ';
            }
            $select_category[$cate->id] = $cate->name . $status;
        }


        $home_ads = [
            'slider' => 'بجانب الإسلايدر في الصفحه الرئيسيه " أفضل مقاس 350 * 300 " ',
            'news1' => 'أسفل المربع الإخباري الأول " أفضل مقاس 728 * 90 " ',
            'news2' => 'أسفل المربع الإخباري الثاني " أفضل مقاس 728 * 90 " ',
            'news3' => 'أسفل المربع الإخباري الثالث " أفضل مقاس 728 * 90 " ',
            'news4' => 'أسفل المربع الإخباري الرابع " أفضل مقاس 728 * 90 " ',
            'news5' => 'أسفل المربع الإخباري الخامس " أفضل مقاس 728 * 90 " ',
            'footer' => 'آخر الصفحه " أفضل مقاس 350 * 900 " ',
        ];
        return view('AdminPanel.Ads.UpdateAd',
            [
                'PageTitle' => ' تعديل إعلان',
                'ad' => $ad,
                'Active' => 'AllAds',
                'select_category' => $select_category,
                'home_ads' => $home_ads,
            ]);
    }


    public function postUpdateAd($AdID, Request $request)
    {
        $ad = Ad::find($AdID);
        $this->validate($request, [
            'ad_name' => 'nullable|required_if:ad_code,=,""|string|max:80',
            'ad_type' => 'required',
            'ad_category_id' => 'nullable',
            'ad_position' => 'nullable',
            'ad_publishDate' => 'required|date',
            'ad_expireDate' => 'required|date|after:ad_publishDate',
            'ad_link' => 'nullable|url|required_if:ad_code,=,""',
            'ad_code' => 'nullable|required_if:ad_link,=,null',
            'number' => 'nullable|numeric',
        ], [
            'ad_name.required_if' => 'من فضلك أدخل عنوان الإعلان',
            'ad_link.required_if' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
            'ad_code.required_if' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
        ]);

        if($request['ad_type'] == 'popup' && $request['ad_code'] != ''){
            session()->flash('Faild', 'عفواً كود الإعلان لا يمكن إضافته كإعلان منبثق');
            return back()->withInput();

        }

        if ($request['ad_link'] != '' && $request['ad_code'] == '') {
            $this->validate($request, [
                'ad_image' => 'nullable|file|mimes:jpeg,jpg,png,gif|required_if:ad_link,=,null',
            ], [
                'ad_image.required_if' => 'عفواً عليك إدخال كود الإعلان أو إخال رابط الإعلان وصورته',
            ]);
        }

        if ($request['status'] == 'active' && (strtotime($request['ad_expireDate']) < strtotime('now'))) {
            $ad->publishDate = $request['ad_publishDate'];
            $ad->publishTime = strtotime($request['ad_publishDate']);
            $ad->expireDate = $request['ad_expireDate'];
            $ad->expireTime = strtotime($request['ad_expireDate']);
            $ad->status = 'inactive';
            $ad->update();
            session()->flash('Faild', 'عفواً تاريخ إنتهاء الإعلان يجب أن يكون أكبر من الوقت الحالي لتتمكن من تفعيل الإعلان');
            return back()->withInput();
        } else {
            $ad->status = $request['status'];
        }

        $ad->name = $request['ad_name'];
        $ad->type = $request['ad_type'];
        $ad->category_id = $request['ad_category_id'];
        $ad->position = $request['ad_position'];
        $ad->publishDate = $request['ad_publishDate'];
        $ad->publishTime = strtotime($request['ad_publishDate']);
        $ad->expireDate = $request['ad_expireDate'];
        $ad->expireTime = strtotime($request['ad_expireDate']);
        $ad->link = $request['ad_link'];
        $ad->code = $request['ad_code'];
        $ad->number = $request['number'];


        if ($ad->update()) {
            if ($request->hasFile('ad_image')) {
                $image_path = base_path() . '/storage/app/ads/' . $ad->id . '/' . $ad->image;
                File::delete($image_path);

                $file = $request['ad_image'];
                $FileExt = $file->extension();
                $NewFileName = time() . '_' . $ad->id . '_' . rand(1, 99999999) . '.' . $FileExt;
                $file->storeAs('ads/' . $ad->id, $NewFileName);
                $ad->image = $NewFileName;
                $ad->update();
            }
            session()->put('Success', 'تم تعديل الإعلان بنجاح');
            return back();
        } else {
            session()->put('Faild', 'حدث خطأ ما من فضلك حاول مره أخرى');
            return back();
        }
    }


    public function DeleteAd($AdID)
    {
        $ad = Ad::find($AdID);
        $FolderPath = base_path() . '/storage/app/ads/' . $ad->id;
        if (File::exists($FolderPath)) File::deleteDirectory($FolderPath);

        if ($ad->delete()) {
            return Response::json($AdID);
        } else {
            return Response::json("false");
        }
    }


}
