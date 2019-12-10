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
         <div class="inner-header ">
            <div class="overlay">
                <div class="container">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Attend')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="page" style="margin-top:50px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h2>CAIRO LIFT-TECH SHOW</h2>
                        </div>
                        <div class="m-b-25">
                            <p>Dear Visitor, simply fill the below form to get our free invitation to CAIRO LIFT-TECH SHOW 16-17-18 January 2020 .
                            </p>
                            Visitors who require a letter of invitation in order to apply for a visa to enter Egypt can follow this link to immediately create the letter of invitation <a href="http://www.interadamena.com"><b>Click Here</b></a> .
                        </div>
                        <div class="f5-bg simple-shadow the-form">
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
                            {!! Form::open() !!}

                                {!! csrf_field() !!}

                                {{ Form::hidden('formType','contactPage') }}
                                <div class="form-row">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('PersonName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Name')))}}
                                        @if ($errors->has('PersonName'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('PersonName') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('CompanyName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.CompanyName')))}}
                                        @if ($errors->has('CompanyName'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('CompanyName') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Title','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Title')))}}
                                        @if ($errors->has('Title'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Title') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Activity','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Activity')))}}
                                        @if ($errors->has('Activity'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Activity') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Email','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.EmailAddress')))}}
                                        @if ($errors->has('Email'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Email') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Address','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Address')))}}
                                        @if ($errors->has('Address'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Address') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Phone','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Phone')))}}
                                        @if ($errors->has('Phone'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Phone') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Mobile','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Mobile')))}}
                                        @if ($errors->has('Mobile'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Mobile') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Security','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Security')))}}
                                        @if ($errors->has('Security'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Security') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-12">
                                        {{Form::textarea('msg','',array('rows'=>3,'required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>trans('Site.Message')))}}
                                        @if ($errors->has('msg'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('Site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('msg') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-custom bold w-100">{{trans('Site.Send')}}</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection