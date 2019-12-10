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

<html dir="{{trans('Site.dir')}}" lang="{{trans('Site.StyleFolder')}}">
    <head>
        <meta charset="UTF-8" />
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
                {{$setting['title']->value != '' ? $setting['title']->value.$title  : 'Cairo Left-Tech Show '.$title}}

            @endif
        </title>
        <link rel="shortcut icon" href="{{URL::to($fav_path)}}" sizes="25x25">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/bootstrap4/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/css/animate.css" type="text/css">
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/css/fonts/fontawesome/css/all.css">

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/owl-carousel/owl.carousel.css" />
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/owl-carousel/owl.theme.css" />
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/owl-carousel/owl.transitions.css" />

        <!-- lightbox -->
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/lightbox2/src/css/lightbox.css">

        <!-- Main Style -->
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/css/basic.css" type="text/css">
        <link rel="stylesheet" href="{{URL::to('/')}}/SiteAssets/Technomasr/css/style.css" type="text/css">


    </head>
    <body>       


        @include('FrontEnd.Layouts.Header')

        @yield('content')

        @include('FrontEnd.Layouts.Footer')


        <!-- scripts -->
        <!-- jquery file -->
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/js/jquery.js"></script>

        <!-- bootstrap js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/bootstrap4/js/bootstrap.min.js"></script>
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/css/fonts/fontawesome/js/all.js"></script>
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/js/wow.js"></script>
        <!-- include Owl Carousel plugin js-->
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/owl-carousel/owl.carousel.min.js"></script>
        <!-- lightbox -->
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/lightbox2/src/js/lightbox.js"></script>
        <script> wow = new WOW({
            boxClass: 'wow',      // default
            animateClass: 'animated', // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
            }
            )
            wow.init();
        </script>

        <script>
            $('#myCarousel').carousel({
                interval: 3000,
            })
        </script>
        <script src="{{URL::to('/')}}/SiteAssets/Technomasr/js/script.js"></script>
        @yield('script')


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5dbdd26ee4c2fa4b6bd9b0d0/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

    </body>
</html>