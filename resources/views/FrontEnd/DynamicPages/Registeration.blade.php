@extends('FrontEnd.Layouts.Master')
<?php
$Setting = \App\Setting::get()->keyBy('key')->all();

?>
@section('content')

    <section class="container sec-padding">
        <div class="row no-margin">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$seo_title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- services -->
            <section>
                <div class="row no-margin m-t-20">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    للإشتراك املأ البيانات التالية
                                </h5>
                            </div>
                            {{Form::open(['files'=>'true'])}}
                                @if(Session::get('Success') != '')
                                    <div class="row p-15">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success" role="alert">
                                                {{Session::get('Success')}}
                                                {{Session::forget('Success')}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row p-15">
                                    @if($Type != 'RegisterTrainer')
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">نوع التسجيل</label>
                                                <select name="CompanyName" class="form-control" id="exampleFormControlSelect1" style="padding: .2rem .75rem;">
                                                    <option value="Person">فردى</option>
                                                    <option value="Company">شركة</option>
                                                </select>
                                                @if ($errors->has('CompanyName'))
                                                    <label id="CompanyName-error" class="error" for="CompanyName">{{ $errors->first('CompanyName') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">الإسم</label>
                                            <input name="PersonName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="اكتب الاسم ثلاثي" reqiured>
                                            @if ($errors->has('PersonName'))
                                                <label id="PersonName-error" class="error" for="PersonName">{{ $errors->first('PersonName') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    @if($Type == 'RegisterTrainer')
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">الوظيفة/البرنامج التدريبى</label>
                                                <input name="CompanyName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="اكتب الاسم ثلاثي" reqiured>
                                                @if ($errors->has('CompanyName'))
                                                    <label id="CompanyName-error" class="error" for="CompanyName">{{ $errors->first('CompanyName') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">الهاتف</label>
                                            <input name="Phone" type="text" class="form-control" id="exampleFormControlInput1" placeholder="رقم هاتف ثابت او جوال" reqiured>
                                            @if ($errors->has('Phone'))
                                                <label id="Phone-error" class="error" for="Phone">{{ $errors->first('Phone') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">المدينة</label>
                                            <input name="Address" type="text" class="form-control" id="exampleFormControlInput1">
                                            @if ($errors->has('Address'))
                                                <label id="Address-error" class="error" for="Address">{{ $errors->first('Address') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">واتس اب</label>
                                            <input name="Mobile" type="text" class="form-control" id="exampleFormControlInput1" placeholder="رقم واتس اب الخاص بك">
                                            @if ($errors->has('Mobile'))
                                                <label id="Mobile-error" class="error" for="Mobile">{{ $errors->first('Mobile') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">البريد الإلكترونى</label>
                                            <input name="Email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="اكتب بريد إلكترونى صالح مثال: name@example.com">
                                            @if ($errors->has('Email'))
                                                <label id="Email-error" class="error" for="Email">{{ $errors->first('Email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">المؤهل</label>
                                            <input name="Title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="اخر شهادة مؤهل حصلت عليها">
                                            @if ($errors->has('Title'))
                                                <label id="Title-error" class="error" for="Title">{{ $errors->first('Title') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    @if($Type == 'RegisterTrainer')
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">إرفاق ملف</label>
                                                <input name="file" type="file" class="form-control">
                                                @if ($errors->has('file'))
                                                    <label id="file-error" class="error" for="file">{{ $errors->first('file') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">رسالة توضيحية</label>
                                            <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            @if ($errors->has('msg'))
                                                <label id="msg-error" class="error" for="msg">{{ $errors->first('msg') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary">اشترك الآن</button>
                                    </div>
                                    {{Form::hidden('CourseID',$Type)}}
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </section>
        <!-- #END# services -->
    </section>

@endsection

