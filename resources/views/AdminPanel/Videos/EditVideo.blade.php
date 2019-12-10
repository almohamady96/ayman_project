@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">رئيسية لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Videos') }}">إدارة الفيديوهات</a></li>
        <li class="active">إضافة فيديو جديد</li>
    </ol>

    {!! Form::open(['files'=>true]) !!}
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            بيانات الفيديو
                            <small>{{ trans('Site.FillFormInputs') }}</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">عنوان الفيديو باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('VideoTitle_ar')) error @endif">
                                        {{ Form::text('VideoTitle_ar',$Video->VideoTitle_ar,array('id'=>'VideoTitle_ar','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('VideoTitle_ar')) 
                                        <label id="VideoTitle_ar-error" class="error" for="VideoTitle_ar">{{ $errors->first('VideoTitle_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">عنوان الفيديو باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('VideoTitle_en')) error @endif">
                                        {{ Form::text('VideoTitle_en',$Video->VideoTitle_en,array('id'=>'VideoTitle_en','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('VideoTitle_en')) 
                                        <label id="VideoTitle_en-error" class="error" for="VideoTitle_en">{{ $errors->first('VideoTitle_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h2 class="card-inside-title">رابط فيديو يوتيوب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('VideoCode')) error @endif">
                                        {{ Form::text('VideoCode','https://www.youtube.com/watch?v='.$Video->VideoCode,array('id'=>'VideoCode','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('VideoCode')) 
                                        <label id="VideoCode-error" class="error" for="VideoCode">{{ $errors->first('VideoCode') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <h2 class="card-inside-title">الترتيب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Ordered')) error @endif">
                                        {{ Form::number('Ordered',$Video->Ordered,array('id'=>'Ordered','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Ordered')) 
                                        <label id="Ordered-error" class="error" for="Ordered">{{ $errors->first('Ordered') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الوصف باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('VideoDes_ar')) error @endif">
                                        {{ Form::textarea('VideoDes_ar',$Video->VideoDes_ar,array('id'=>'VideoDes_ar','class'=>'form-control','rows'=>'3')) }}
                                    </div>
                                    @if ($errors->has('VideoDes_ar')) 
                                        <label id="VideoDes_ar-error" class="error" for="VideoDes_ar">{{ $errors->first('VideoDes_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الوصف باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('VideoDes_en')) error @endif">
                                        {{ Form::textarea('VideoDes_en',$Video->VideoDes_en,array('id'=>'VideoDes_en','class'=>'form-control','rows'=>'3')) }}
                                    </div>
                                    @if ($errors->has('VideoDes_en'))
                                        <label id="VideoDes_en-error" class="error" for="VideoDes_en">{{ $errors->first('VideoDes_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <h2 class="card-inside-title">
                                    صورة الفيديو
                                    <small>يمكنك رفع صورة رمزية للفيديو مختلفة عن الصورة الرسمية من يوتيوب</small>
                                </h2>
                                <div class="form-group">
                                    @if($Video->VideoPhoto != '')
                                        <img src="{{ asset('storage/app/public/Videos/'.$Video->id.'/'.$Video->VideoPhoto) }}" style="max-height:120px;">
                                    @else
                                        <img src="https://img.youtube.com/vi/{{ $Video->VideoCode }}/0.jpg" style="max-height:120px;">
                                    @endif
                                    <div class="form-group center">
                                        <input name="VideoPhoto" class="file" type="file">
                                    </div>
                                    @if ($errors->has('VideoPhoto')) 
                                        <label id="VideoPhoto-error" class="error" for="VideoPhoto">{{ $errors->first('VideoPhoto') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{ Form::submit(trans('Site.Save'),array('value'=>trans('Site.Save'),'class'=>'btn bg-teal waves-effect')) }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->

    {!! Form::close() !!}

@stop