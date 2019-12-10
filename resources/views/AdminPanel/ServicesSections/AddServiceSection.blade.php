@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">رئيسية لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Services') }}">إدارة الدورات التدريبية</a></li>
        <li><a href="{{ URL::to('/AdminPanel/ServicesSections') }}">إدارة أقسام الدورات التدريبية</a></li>
        <li class="active">إضافة قسم جديد</li>
    </ol>

    {!! Form::open(['files'=>true]) !!}
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            بيانات القسم
                            <small>{{ trans('Site.FillFormInputs') }}</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-5">
                                <h2 class="card-inside-title">عنوان القسم باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Title_ar')) error @endif">
                                        {{ Form::text('Title_ar','',array('id'=>'Title_ar','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Title_ar')) 
                                        <label id="Title_ar-error" class="error" for="Title_ar">{{ $errors->first('Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <h2 class="card-inside-title">عنوان القسم باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Title_en')) error @endif">
                                        {{ Form::text('Title_en','',array('id'=>'Title_en','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Title_en')) 
                                        <label id="Title_en-error" class="error" for="Title_en">{{ $errors->first('Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">الترتيب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Ordered')) error @endif">
                                        {{ Form::text('Ordered','',array('id'=>'Ordered','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Ordered')) 
                                        <label id="Ordered-error" class="error" for="Ordered">{{ $errors->first('Ordered') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">صورة القسم</h2>
                                <div class="form-group">
                                    <div class="form-group center">
                                        <div id="Logo-holder" class="col-sm-12">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="btn">
                                            <input id="LogoUpload" name="photo" type="file">
                                        </div>
                                        @if ($errors->has('photo')) 
                                            <label id="name-error" class="error" for="name">{{ $errors->first('photo') }}</label>
                                        @endif
                                    </div>
                                    @if ($errors->has('photo')) 
                                        <label id="photo-error" class="error" for="photo">{{ $errors->first('photo') }}</label>
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