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
                            <li class="breadcrumb-item active" aria-current="page">{{trans('Site.BookStand')}}</li>
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
                            <h4>SPACE RESERVATION FORM (This form is not a contract)</h4>
                        </div>
                        <ul class="m-b-30 m-t-15">
                            <li>*Please complete the reservation form below to receive the floor plan and quotation for your stand.
                            </li>
                            <li>
                                *The form is just a reservation interest notice to the organizer.
                            </li>
                            <li>*You have to ask for CAIRO LIFT-TECH SHOW contract application to confirm your space reservation.</li>
                            <li>
                                *Once we receive your Email we will send you the floor plan with 2 location options for you to choose.
                            </li>
                            <li>
                                *Allocations will be made on a first-come, first- serve basis.
                            </li>
                        </ul>
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
                                        {{Form::text('CompanyName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.CompanyName')))}}
                                        @if ($errors->has('CompanyName'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('CompanyName') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('PersonName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Name')))}}
                                        @if ($errors->has('PersonName'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('PersonName') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Country','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Country')))}}
                                        @if ($errors->has('Country'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Country') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Title','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Title')))}}
                                        @if ($errors->has('Title'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Title') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Activity','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Activity')))}}
                                        @if ($errors->has('Activity'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Activity') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Phone','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Phone')))}}
                                        @if ($errors->has('Phone'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Phone') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('Email','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.EmailAddress')))}}
                                        @if ($errors->has('Email'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('Email') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('WebSite','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.WebSite')))}}
                                        @if ($errors->has('WebSite'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('WebSite') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        {{Form::text('SQM','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.SQM')))}}
                                        @if ($errors->has('SQM'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                                <span>{{ $errors->first('SQM') }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="form-group col-12">
                                        {{Form::textarea('msg','',array('rows'=>3,'required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>trans('Site.Message')))}}
                                        @if ($errors->has('msg'))
                                            <label class="warning m-t-10">
                                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
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