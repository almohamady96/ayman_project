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
                    {{trans('Site.Careers')}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Careers')}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="contact container p-t-50 p-b-50">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="title text-center">
                        <h2>احصل على وظيفة الان</h2>
                    </div>
                    <ul class="p-0 info m-b-30">
                        @if($setting['mobile']->value != '')
                            <li>
                                <a href="tel:{{$setting['mobile']->value}}">
                                    <i class="fas fa-phone m-l-5"></i>
                                    {{$setting['mobile']->value}}
                                </a>
                            </li>
                        @endif
                        @if($setting['whatsApp']->value != '')
                            <li>
                                <a href="https://api.whatsapp.com/send?phone={{$setting['whatsApp']->value}}" target="_blank">
                                    <i class="fab fa-whatsapp m-l-5"></i>
                                    {{$setting['whatsApp']->value}}
                                </a>
                            </li>
                        @endif
                        @if($setting['email']->value != '')
                            <li>
                                <a href="mailto:{{$setting['email']->value}}">
                                    <i class="far fa-envelope m-l-5"></i>
                                    {{$setting['email']->value}}
                                </a>
                            </li>
                        @endif
                        <div class="clearfix"></div>
                    </ul>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="الاسم">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="البريد الالكترونى">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="العنوان">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="رقم الهاتف">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="المسمى الوظيفى">
                        </div>
                        <div class="form-group">
                            <input id="cv" type="file" placeholder="ارفاق السيرة الذانيه" />
                            <label for="cv">ارفاق السيرة الذانيه</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn gradient-center-X m-t-30">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection