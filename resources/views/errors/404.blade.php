<!DOCTYPE html>
<html dir="rtl" lang="ar">
<?php
$setting = \App\Setting::get()->keyBy('key')->all();

if ($setting['logo']->value != '') {
    $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
} else {
    $logo_path = '/SiteAssets/style/images/logo.png';
}

if ($setting['fav']->value != '') {
    $fav_path = '/storage/app/Settings/' . $setting['fav']->value;
} else {
    $fav_path = '/SiteAssets/style/images/logo.png';
}


?>

<head>
    <meta charset="UTF-8"/>
    <meta name="description"
          content="{{ isset($seo_description) && $seo_description != '' ? $seo_description : $setting['description']->value }}"/>
    <meta name="keywords"
          content="{{ isset($seo_keywords) && $seo_keywords != '' ? $seo_keywords : $setting['keywords']->value }}">
    <meta name="author" content="{{  isset($seo_title) && $seo_title != '' ? $seo_title : $setting['title']->value}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="{{ isset($seo_title) && $seo_title != '' ? $seo_title :  $setting['title']->value}}"/>
    <meta property="og:description"
          content="{{ isset($seo_description) && $seo_description != ''? $seo_description: $setting['description']->value}}"/>
    <meta property="og:image"
          content="{{ isset($seo_img) && $seo_img!= '' ? URL::to($seo_img) : URL::to($logo_path) }}"/>
    <meta property="og:site_name" content="{{ $setting['title']->value }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($seo_title))
            {{ $seo_title}}
        @else
            <?php
            $title = isset($PageTitle) ? ' | ' . $PageTitle : '';
            ?>
            {{$setting['title']->value != ''? $setting['title']->value.$title  : 'الشامل واحد '.$title}}

        @endif
    </title>

    <link rel="shortcut icon" href="{{URL::to($fav_path)}}" sizes="25x25">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/bootstrap4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/my-style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/animate.css" type="text/css" />

    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/light-style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/dark-style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/blue-style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/green-style.css" type="text/css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/css/redDarken-style.css" type="text/css" />

    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/owl-carousel/owl.theme.css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/style/owl-carousel/owl.transitions.css" />

</head>
<style>
    @media(max-width: 360px){
        .not-found h3{font-size: 21px;}
    }
</style>

<body>

<div class="not-found text-center p-t-50 m-t-50">
    <div class="image m-t-40" style="background-color: transparent;">
        <img src="{{URL::to('/')}}/SiteAssets/style/images/404.png" alt="{{$setting['title']->value}}" />
    </div>
    <h3 class="m-t-30 m-b-40">الصفحة المطلوبة غير موجوده حاليا</h3>
    <a href="{{url('/')}}" class="btn text-white p-r-20 p-l-20 p-t-10 p-b-10" style="background-color: #4B4B4B;">العوده الى الصفحه الرئيسية</a>
</div>

<script src="{{URL::to('/')}}/SiteAssets/style/js/jquery.js"></script>
<script src="{{URL::to('/')}}/SiteAssets/style/bootstrap4/js/popper.min.js"></script>
<script src="{{URL::to('/')}}/SiteAssets/style/bootstrap4/js/bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/SiteAssets/style/js/script.js"></script>

<!-- include Owl Carousel plugin js-->
<script src="{{URL::to('/')}}/SiteAssets/style/owl-carousel/owl.carousel.min.js"></script>

<!-- include BreakingNews js-->
<script src="{{URL::to('/')}}/SiteAssets/style/js/scrollbox.js"></script>

<script src="{{URL::to('/')}}/SiteAssets/style/js/wow.js"></script>
<script> wow = new WOW(
        {
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
        }
    )
    wow.init();
</script>
</body>

</html>