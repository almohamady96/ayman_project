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




    <main>
        <div class="inner-header">
            <div class="container">
                <h3 class="breadcrumb-title text-white bold">
                    {{trans('Site.AboutUs')}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('Site.AboutUs')}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="about-page container p-t-50 p-b-50">
            <div class="row no-margin">
                @if ($setting['AboutBox1Title_'.Session::get('Lang')]->value != '')
                <div class="col-md-4 item m-b-30">
                    <div class="item text-center">
                        <h4>{{$setting['AboutBox1Title_'.Session::get('Lang')]->value}}</h4>
                        <p>
                            {{$setting['AboutBox1Txt_'.Session::get('Lang')]->value}}
                        </p>
                    </div>
                </div>
                @endif
                @if ($setting['AboutBox2Title_'.Session::get('Lang')]->value != '')
                <div class="col-md-4 item m-b-30">
                    <div class="item text-center">
                        <h4>{{$setting['AboutBox2Title_'.Session::get('Lang')]->value}}</h4>
                        <p>
                            {{$setting['AboutBox2Txt_'.Session::get('Lang')]->value}}
                        </p>
                    </div>
                </div>
                @endif
                @if ($setting['AboutBox3Title_'.Session::get('Lang')]->value != '')
                <div class="col-md-4 item m-b-30">
                    <div class="item text-center">
                        <h4>{{$setting['AboutBox3Title_'.Session::get('Lang')]->value}}</h4>
                        <p>
                            {{$setting['AboutBox3Txt_'.Session::get('Lang')]->value}}
                        </p>
                    </div>
                </div>
                @endif
            </div>
            <div class="heads">
                @if ($setting['AboutTeamTitle_'.Session::get('Lang')]->value != '')
                    <div class="title text-center">
                        <h2>{{$setting['AboutTeamTitle_'.Session::get('Lang')]->value}}</h2>
                        <p>
                            {{$setting['AboutBoxTxt_'.Session::get('Lang')]->value}}
                        </p>
                    </div>
                @endif
                <div class="row justify-content-center">

                    @if ($setting['TeamMember1Name_'.Session::get('Lang')]->value != '')
                        <div class="col-lg-3 col-sm-6 col-11">
                            <div class="head m-b-30">
                                <figure class="m-b-0 bg-light">
                                    @if (isset($setting['TeamMember1Photo']->value) && $setting['TeamMember1Photo']->value != '')
                                        <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember1Photo']->value) }}" alt="">
                                    @else
                                        <img src="{{url('/')}}/SiteAssets/images/head1.jpg" alt=""><!-- 300*300-->
                                    @endif
                                </figure>
                                <div class="info text-center bg-light p-20">
                                    <h4>{{$setting['TeamMember1Name_'.Session::get('Lang')]->value}}</h4>
                                    <h6 class="secondary-color bold">{{$setting['TeamMember1Title_'.Session::get('Lang')]->value}}</h6>
                                    <hr/>
                                    <ul class="p-0">
                                        @if (isset($setting['TeamMember1FB']->value) && $setting['TeamMember1FB']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember1FB']->value}}" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember1Twitter']->value) && $setting['TeamMember1Twitter']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember1Twitter']->value}}" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember1Li']->value) && $setting['TeamMember1Li']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember1Li']->value}}" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember1GPlus']->value) && $setting['TeamMember1GPlus']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember1GPlus']->value}}" target="_blank">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($setting['TeamMember2Name_'.Session::get('Lang')]->value != '')
                        <div class="col-lg-3 col-sm-6 col-11">
                            <div class="head m-b-30">
                                <figure class="m-b-0 bg-light">
                                    @if (isset($setting['TeamMember2Photo']->value) && $setting['TeamMember2Photo']->value != '')
                                        <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember2Photo']->value) }}" alt="">
                                    @else
                                        <img src="{{url('/')}}/SiteAssets/images/head1.jpg" alt=""><!-- 300*300-->
                                    @endif
                                </figure>
                                <div class="info text-center bg-light p-20">
                                    <h4>{{$setting['TeamMember2Name_'.Session::get('Lang')]->value}}</h4>
                                    <h6 class="secondary-color bold">{{$setting['TeamMember2Title_'.Session::get('Lang')]->value}}</h6>
                                    <hr/>
                                    <ul class="p-0">
                                        @if (isset($setting['TeamMember2FB']->value) && $setting['TeamMember2FB']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember2FB']->value}}" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember2Twitter']->value) && $setting['TeamMember2Twitter']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember2Twitter']->value}}" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember2Li']->value) && $setting['TeamMember2Li']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember2Li']->value}}" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember2GPlus']->value) && $setting['TeamMember2GPlus']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember2GPlus']->value}}" target="_blank">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($setting['TeamMember3Name_'.Session::get('Lang')]->value != '')
                        <div class="col-lg-3 col-sm-6 col-11">
                            <div class="head m-b-30">
                                <figure class="m-b-0 bg-light">
                                    @if (isset($setting['TeamMember3Photo']->value) && $setting['TeamMember3Photo']->value != '')
                                        <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember3Photo']->value) }}" alt="">
                                    @else
                                        <img src="{{url('/')}}/SiteAssets/images/head1.jpg" alt=""><!-- 300*300-->
                                    @endif
                                </figure>
                                <div class="info text-center bg-light p-20">
                                    <h4>{{$setting['TeamMember3Name_'.Session::get('Lang')]->value}}</h4>
                                    <h6 class="secondary-color bold">{{$setting['TeamMember3Title_'.Session::get('Lang')]->value}}</h6>
                                    <hr/>
                                    <ul class="p-0">
                                        @if (isset($setting['TeamMember3FB']->value) && $setting['TeamMember3FB']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember3FB']->value}}" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember3Twitter']->value) && $setting['TeamMember3Twitter']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember3Twitter']->value}}" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember3Li']->value) && $setting['TeamMember3Li']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember3Li']->value}}" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember3GPlus']->value) && $setting['TeamMember3GPlus']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember3GPlus']->value}}" target="_blank">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($setting['TeamMember4Name_'.Session::get('Lang')]->value != '')
                        <div class="col-lg-3 col-sm-6 col-11">
                            <div class="head m-b-30">
                                <figure class="m-b-0 bg-light">
                                    @if (isset($setting['TeamMember4Photo']->value) && $setting['TeamMember4Photo']->value != '')
                                        <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember4Photo']->value) }}" alt="">
                                    @else
                                        <img src="{{url('/')}}/SiteAssets/images/head1.jpg" alt=""><!-- 300*300-->
                                    @endif
                                </figure>
                                <div class="info text-center bg-light p-20">
                                    <h4>{{$setting['TeamMember4Name_'.Session::get('Lang')]->value}}</h4>
                                    <h6 class="secondary-color bold">{{$setting['TeamMember4Title_'.Session::get('Lang')]->value}}</h6>
                                    <hr/>
                                    <ul class="p-0">
                                        @if (isset($setting['TeamMember4FB']->value) && $setting['TeamMember4FB']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember4FB']->value}}" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember4Twitter']->value) && $setting['TeamMember4Twitter']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember4Twitter']->value}}" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember4Li']->value) && $setting['TeamMember4Li']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember4Li']->value}}" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($setting['TeamMember4GPlus']->value) && $setting['TeamMember4GPlus']->value != '')
                                            <li>
                                                <a href="{{$setting['TeamMember4GPlus']->value}}" target="_blank">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

@endsection