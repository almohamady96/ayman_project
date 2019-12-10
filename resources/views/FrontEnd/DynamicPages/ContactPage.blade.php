@extends('FrontEnd.Layouts.Master')

@section('content')
    <?php
    $setting = \App\Setting::get()->keyBy('key')->all();
    if ($setting['logo']->value != '') {
        $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
    } else {
        $logo_path = '/SiteAssets/style/images/logo.png';
    }

    ?>

    <section id="content">
        <div class="container sec-padding">
            <div class="row no-margin">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('Site.ContactUs')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
           <div class="row no-margin">
                @if($setting['map']->value != '')
                    <div class="col-12 m-b-15">
                        <div class="map">
                            {!!$setting['map']->value!!}
                        </div>
                    </div>
                @endif
                <div class="col-md-7">
                    <ul class="contact">
                        @if($setting['address_'.Session::get('Lang')]->value != '')
                            <li class="m-t-5">
                                <i class="fas fa-map-marker-alt  m-r-5"></i>
                                {{$setting['address_'.Session::get('Lang')]->value}}
                            </li>
                        @endif
                        @if($setting['email']->value != '')
                            <li class="m-t-5">
                                <a href="mailto:{{$setting['email']->value}}">
                                    <i class="far fa-envelope  m-r-5"></i>
                                    {{$setting['email']->value}}
                                </a>
                            </li>
                        @endif
                        @if($setting['phone']->value != '')
                            <li class="m-t-5">
                                <a href="tel:{{$setting['phone']->value}}">
                                    <i class="fas fa-phone  m-r-5"></i>
                                    {{$setting['phone']->value}}
                                </a>
                            </li>
                        @endif
                        @if($setting['mobile']->value != '')
                            <li class="m-t-5">
                                <a href="tel:{{$setting['mobile']->value}}">
                                    <i class=" fa fa-phone-square  m-r-5"></i>
                                    {{$setting['mobile']->value}}
                                </a>
                            </li>
                        @endif
                           
                    </ul>
               </div>
               
               <div class="col-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::get('Success'))
                        <div class="alert alert-success">
                            <p>
                                {{trans('Site.RequestSetSuccessfully')}}
                            </p>
                        </div>
                        {{Session::forget('Success')}}
                    @endif
                    @if (Session::get('Faild'))
                        <div class="alert alert-danger">
                            <p>
                                {{Session::get('Faild')}}
                            </p>
                        </div>
                        {{Session::forget('Faild')}}
                    @endif
                    {!! Form::open() !!}

                        {!! csrf_field() !!}

                        {{ Form::hidden('formType','contactPage') }}
                        <div class="form-row">
                            <div class="form-group col-6">
                                {{Form::text('userName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Name')))}}
                                @if ($errors->has('userName'))
                                    <label class="warning m-t-10">
                                        <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                        <span>{{ $errors->first('userName') }}</span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                {{Form::email('email','',array('required'=>'true','class'=>'form-control','id'=>'email','placeholder'=>trans('Site.email')))}}
                                @if ($errors->has('email'))
                                    <label class="warning m-t-10">
                                        <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                        <span>{{ $errors->first('email') }}</span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                {{Form::text('mobile','',array('required'=>'true','class'=>'form-control','id'=>'mobile','placeholder'=>trans('Site.Phone')))}}
                                @if ($errors->has('mobile'))
                                    <label class="warning m-t-10">
                                        <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                        <span>{{ $errors->first('mobile') }}</span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group col-12">
                                {{Form::textarea('contactContent','',array('rows'=>3,'required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>'الاستفسارات/الاهتمامات'))}}
                                @if ($errors->has('contactContent'))
                                    <label class="warning m-t-10">
                                        <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                        <span>{{ $errors->first('contactContent') }}</span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line @if($errors->has('contactContent')) error @endif">
                                معادلة التحقق البشرى
                                ناتج:
                                <?php
                                    $T1 = rand(1, 9);
                                    $T2 = rand(1, 9);
                                    $T3 = $T1 + $T2;
                                ?>
                                {{$T1}} + {{$T2}} =
                                {{Form::text('recaptcha','',array('required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>'اكتب الناتج هنا'))}}
                                <input name="T3" type="hidden" value="{{$T3}}" />
                            </div>
                            @if ($errors->has('contactContent'))
                                <label class="warning m-t-0">
                                    <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                    <span>{{ $errors->first('contactContent') }}</span>
                                </label>
                            @endif
                        </div>
                        <div class="clearfix"></div>

                        <button type="submit" class="btn btn-custom bold w-100">{{trans('Site.Send')}}</button>
                        {!! Form::close() !!}

                </div>
           </div>
        </div>
    </section>



@endsection