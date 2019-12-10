<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\ServicesSections;
use Response;
use File;

class ServicesController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ServicesSections()
    {
    	$ServicesSections = ServicesSections::orderBy('id','desc')->get();
    	return View('AdminPanel.ServicesSections.ServicesSections',[
    			'ServicesSections' => $ServicesSections,
    			'Active' => 'ServicesSections',
    			'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات'
    		]);
    }

    public function AddServiceSection()
    {
        return view('AdminPanel.ServicesSections.AddServiceSection', 
                            [
                                'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات - خدمة جديدة',
                                'Active' => 'ServicesSections',
                            ]);
    }

    public function SubmitServiceSection(Request $request)
    {
        $this->validate($request, [
            'Title_ar' 		=> 'required',
            'Title_en' 		=> 'required',
            'photo' 		=> 'required|image',
            'Ordered' 		=> 'required',
        ]);


        $Service = New ServicesSections;
        $Service->Title_ar 		= $request->Title_ar;
        $Service->Title_en 		= $request->Title_en;
        $Service->Ordered 		= $request->Ordered;

        if ($Service->save()) {
	    	if ($request->hasFile('photo')) {
	        	$Service = ServicesSections::find($Service->id);
	    		$FileExt = $request->photo->extension();
	    		$Name = time().'-'.$Service->id.'.'.$FileExt;
				$request->photo->storeAs('public/ServicesSections/'.$Service->id,$Name);
				$Service->photo	= $Name;
				$Service->save();
	    	}
            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/ServicesSections');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function EditServiceSection($SectionID)
    {
        $Section = ServicesSections::find($SectionID);
        return view('AdminPanel.ServicesSections.EditServiceSection', 
                            [
                                'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات - تعديل بيانات الخدمة',
                                'Active' => 'ServicesSections',
                                'Section' => $Section,
                            ]);
    }

    public function UpdateServiceSection($SectionID,Request $request)
    {
        $this->validate($request, [
            'Title_ar' 		=> 'required',
            'Title_en' 		=> 'required',
            'photo' 		=> 'image',
            'Ordered' 		=> 'required',
        ]);


        $Section = ServicesSections::find($SectionID);
        $Section->Title_ar 		= $request->Title_ar;
        $Section->Title_en 		= $request->Title_en;
        $Section->Ordered 		= $request->Ordered;

        if ($Section->save()) {
	    	if ($request->hasFile('photo')) {
                if ($Section->photo != '') {
                    $photoPath = base_path().'/storage/app/public/ServicesSections/'.$Section->id.'/'.$Section->photo;
                    if(File::exists($photoPath)) File::delete($photoPath);
                }
	        	$Section = ServicesSections::find($Section->id);
	    		$FileExt = $request->photo->extension();
	    		$Name = time().'-'.$Section->id.'.'.$FileExt;
				$request->photo->storeAs('public/ServicesSections/'.$Section->id,$Name);
				$Section->photo	= $Name;
				$Section->save();
	    	}
            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/ServicesSections');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function DeleteServiceSection($SectionID)
    {
        $Section = ServicesSections::find($SectionID);
        $FolderPath = base_path().'/storage/app/public/ServicesSections/'.$Section->id;
        if(File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($Section->delete()) {
            return Response::json($SectionID);
        }else{
            return Response::json("false");
        }
    }

    public function Services()
    {
    	$Services = Services::orderBy('Ordered','asc')->get();
    	return View('AdminPanel.Services.Services',[
    			'Services' => $Services,
    			'Active' => 'Services',
    			'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات'
    		]);
    }

    public function AddService()
    {
    	$Sections = ServicesSections::orderBy('id','desc')->pluck('Title_ar','id');
        return view('AdminPanel.Services.AddService', 
                            [
                                'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات - خدمة جديدة',
                                'Sections' => $Sections,
                                'Active' => 'Services',
                            ]);
    }

    public function SubmitService(Request $request)
    {
        $this->validate($request, [
            'Title_ar' 		=> 'required',
            'Title_en' 		=> 'required',
            'des_ar' 		=> 'required',
            'des_en' 		=> 'required',
            'details_ar'	=> 'required',
            'details_en'	=> 'required',
            'Ordered'	    => 'required',
            'SectionID'	    => 'required',
            'photo'	        => 'required|image',
        ]);

        $Service = New Services;
        $Service->Title_ar 		= $request->Title_ar;
        $Service->Title_en 		= $request->Title_en;
        $Service->des_ar 		= $request->des_ar;
        $Service->des_en 		= $request->des_en;
        $Service->details_ar 	= $request->details_ar;
        $Service->details_en 	= $request->details_en;
        
        $Service->Hours 	= $request->Hours;
        $Service->Days 	    = $request->Days;
        $Service->tab1_ar 	= $request->tab1_ar;
        $Service->tab1_en 	= $request->tab1_en;
        $Service->tab2_ar 	= $request->tab2_ar;
        $Service->tab2_en 	= $request->tab2_en;
        $Service->tab3_ar 	= $request->tab3_ar;
        $Service->tab3_en 	= $request->tab3_en;
        $Service->tab4_ar 	= $request->tab4_ar;
        $Service->tab4_en 	= $request->tab4_en;
        $Service->tab5_ar 	= $request->tab5_ar;
        $Service->tab5_en 	= $request->tab5_en;

        $Service->Ordered 		= $request->Ordered;
        $Service->SectionID 	= $request->SectionID;
        $Service->featured	    = $request->featured;

        if ($Service->save()) {
	    	if ($request->hasFile('photo')) {
	        	$Service = Services::find($Service->id);
	    		$FileExt = $request->photo->extension();
	    		$Name = time().'-'.$Service->id.'.'.$FileExt;
				$request->photo->storeAs('public/Services/'.$Service->id,$Name);
				$Service->photo	= $Name;
				$Service->save();
	    	}
            if ($request->hasFile('photos')) {
                $photos = [];
                $x=1;
                foreach ($request->photos as $file) {
                    $FileExt = $file->extension();
                    $NewFileName = time().''.$x.'-'.$Service->id.'.'.$FileExt;
                    $file->storeAs('public/Services/'.$Service->id.'/photos',$NewFileName);
                    array_push($photos, $NewFileName);
                    $x++;
                }

                $seralizedInput = serialize($photos);
                $Service = Services::find($Service->id);
                $Service->photos = $seralizedInput;
                $Service->save();
            }
            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/Services');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function EditService($ServiceID)
    {
    	$Sections = ServicesSections::orderBy('id','desc')->pluck('Title_ar','id');
        $Service = Services::find($ServiceID);
        return view('AdminPanel.Services.EditService', 
                            [
                                'Title' => 'عيادات د/حلمى سليمان | إدارة الخدمات - تعديل بيانات الخدمة',
                                'Active' => 'Services',
                                'Sections' => $Sections,
                                'Service' => $Service,
                            ]);
    }

    public function UpdateService($ServiceID,Request $request)
    {
        $this->validate($request, [
            'Title_ar' 		=> 'required',
            'Title_en' 		=> 'required',
            'des_ar' 		=> 'required',
            'des_en' 		=> 'required',
            'details_ar'	=> 'required',
            'details_en'	=> 'required',
            'Ordered'	    => 'required',
            'SectionID'	    => 'required',
            'photo'	        => 'image',
        ]);


        $Service = Services::find($ServiceID);
        $Service->Title_ar 		= $request->Title_ar;
        $Service->Title_en 		= $request->Title_en;
        $Service->des_ar 		= $request->des_ar;
        $Service->des_en 		= $request->des_en;
        $Service->details_ar 	= $request->details_ar;
        $Service->details_en 	= $request->details_en;
        
        $Service->Hours 	= $request->Hours;
        $Service->Days 	    = $request->Days;
        $Service->tab1_ar 	= $request->tab1_ar;
        $Service->tab1_en 	= $request->tab1_en;
        $Service->tab2_ar 	= $request->tab2_ar;
        $Service->tab2_en 	= $request->tab2_en;
        $Service->tab3_ar 	= $request->tab3_ar;
        $Service->tab3_en 	= $request->tab3_en;
        $Service->tab4_ar 	= $request->tab4_ar;
        $Service->tab4_en 	= $request->tab4_en;
        $Service->tab5_ar 	= $request->tab5_ar;
        $Service->tab5_en 	= $request->tab5_en;

        $Service->Ordered 		= $request->Ordered;
        $Service->SectionID 	= $request->SectionID;

        if ($Service->save()) {
	    	if ($request->hasFile('photo')) {
                if ($Service->photo != '') {
                    $photoPath = base_path().'/storage/app/public/Services/'.$Service->id.'/'.$Service->photo;
                    if(File::exists($photoPath)) File::delete($photoPath);
                }
	        	$Service = Services::find($Service->id);
	    		$FileExt = $request->photo->extension();
	    		$Name = time().'-'.$Service->id.'.'.$FileExt;
				$request->photo->storeAs('public/Services/'.$Service->id,$Name);
				$Service->photo	= $Name;
				$Service->save();
	    	}
            if ($request->hasFile('photos')) {
                $photos = [];
                $x=1;
                foreach ($request->photos as $file) {
                    $FileExt = $file->extension();
                    $NewFileName = time().''.$x.'-'.$Service->id.'.'.$FileExt;
                    $file->storeAs('public/Services/'.$Service->id.'/photos',$NewFileName);
                    array_push($photos, $NewFileName);
                    $x++;
                }

                $seralizedInput = serialize($photos);
                $Service = Services::find($Service->id);
                $Service->photos = $seralizedInput;
                $Service->save();
            }
            $request->session()->put('PopSuccess', trans('Site.SavedSuccessfully'));
            return redirect('/AdminPanel/Services');
        } else {
            $request->session()->put('Faild', 'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك الأمر!');
            return back();
        }
    }

    public function DeleteService($ServiceID)
    {
        $Service = Services::find($ServiceID);
        $FolderPath = base_path().'/storage/app/public/Services/'.$Service->id;
        if(File::exists($FolderPath)) File::deleteDirectory($FolderPath);
        if ($Service->delete()) {
            return Response::json($ServiceID);
        }else{
            return Response::json("false");
        }
    }
    public function DeleteServicePhoto($ServiceID,$Photo)
    {
        $PhotoPath = base_path().'/storage/app/public/Services/'.$ServiceID.'/photos/'.$Photo;
        if(File::exists($PhotoPath)){
            $DeletePhoto = File::delete($PhotoPath);
            if ($DeletePhoto) {
                return Response::json($Photo);
            }
        }
    }
}
