<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Videos;
use Response;
use File;

class VideosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function Videos()
    {
    	$Videos = Videos::orderBy('id','desc')->get();
    	return View('AdminPanel.Videos.Videos',[
    			'Videos' => $Videos,
    			'Active' => 'Videos',
    			'Title' => 'عيادات دكتور حلمى سليمان | إدارة الفيديوهات'
    		]);
    }

    public function AddVideo()
    {
        return view('AdminPanel.Videos.AddVideo', 
                            [
                                'Title' => 'عيادات دكتور حلمى سليمان | إدارة الفيديوهات - فيديو جديد',
                                'Active' => 'Videos',
                            ]);
    }

    public function SubmitVideo(Request $request)
    {
        $this->validate($request, [
            'VideoTitle_ar' => 'required',
            'VideoTitle_en' => 'required',
            'VideoCode' => 'required',
            'Ordered' => 'required',
        ]);


        $Video = New Videos;
        $Video->VideoTitle_ar   = $request->VideoTitle_ar;
        $Video->VideoTitle_en   = $request->VideoTitle_en;
        $Video->VideoDes_ar 	= $request->VideoDes_ar;
        $Video->VideoDes_en 	= $request->VideoDes_en;
        parse_str( parse_url( $request->VideoCode, PHP_URL_QUERY ), $my_array_of_vars );
        $Video->VideoCode 	    = $my_array_of_vars['v'];
        $Video->Ordered 	    = $request->Ordered;
        if ($Video->save()) {
	    	if ($request->hasFile('VideoPhoto')) {
	        	$Video = Videos::find($Video->id);
	    		$FileExt = $request->VideoPhoto->extension();
	    		$Name = time().'-'.$Video->id.'.'.$FileExt;
				$request->VideoPhoto->storeAs('public/Videos/'.$Video->id,$Name);
				$Video->VideoPhoto	= $Name;
				$Video->save();
	    	}

            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/Videos');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function EditVideo($VideoID)
    {
        $Video = Videos::find($VideoID);
        return view('AdminPanel.Videos.EditVideo', 
                            [
                                'Title' => 'عيادات دكتور حلمى سليمان | إدارة الفيديوهات - تعديل بيانات فيديو',
                                'Active' => 'Videos',
                                'Video' => $Video,
                            ]);
    }

    public function UpdateVideo($VideoID,Request $request)
    {
        $this->validate($request, [
            'VideoTitle_ar' => 'required',
            'VideoTitle_en' => 'required',
            'VideoCode' => 'required',
            'Ordered' => 'required',
        ]);


        $Video = Videos::find($VideoID);
        $Video->VideoTitle_ar   = $request->VideoTitle_ar;
        $Video->VideoTitle_en   = $request->VideoTitle_en;
        $Video->VideoDes_ar 	= $request->VideoDes_ar;
        $Video->VideoDes_en 	= $request->VideoDes_en;
        parse_str( parse_url( $request->VideoCode, PHP_URL_QUERY ), $my_array_of_vars );
        $Video->VideoCode 	    = $my_array_of_vars['v'];
        $Video->Ordered 	    = $request->Ordered;
        if ($request->hasFile('VideoPhoto')) {
            if ($Video->VideoPhoto != '') {
                $VideoPhotoPath = base_path().'/storage/app/public/Videos/'.$Video->id.'/'.$Video->VideoPhoto;
                if(File::exists($VideoPhotoPath)) File::delete($VideoPhotoPath);
            }
            $Video = Videos::find($Video->id);
            $FileExt = $request->VideoPhoto->extension();
            $Name = time().'-'.$Video->id.'.'.$FileExt;
            $request->VideoPhoto->storeAs('public/Videos/'.$Video->id,$Name);
            $Video->VideoPhoto	= $Name;
            $Video->save();
        }

        if ($Video->save()) {
            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/Videos');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function DeleteVideo($VideoID)
    {
        $Videos = Videos::find($VideoID);
        $FolderPath = base_path().'/storage/app/public/Videos/'.$Videos->id;
        if(File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($Videos->delete()) {
            return Response::json($VideoID);
        }else{
            return Response::json("false");
        }
    }
    public function DeleteVideoPhoto($VideoID,$Photo)
    {
        $PhotoPath = base_path().'/storage/app/public/Videos/'.$VideoID.'/'.$Photo;
        if(File::exists($PhotoPath)){
            $Video = Videos::find($VideoID);
            $Video->VideoPhoto = '';
            $Video->save();
            $DeletePhoto = File::delete($PhotoPath);
            if ($DeletePhoto) {
                return Response::json($Photo);
            }
        }
    }
}
