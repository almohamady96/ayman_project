<!DOCTYPE html>
<html dir="rtl">
<?php
$setting = \App\Setting::get()->keyBy('key')->all();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>
        <?php
        $title = isset($PageTitle) ? ' | ' . $PageTitle : '';
        ?>
        {{$setting['title']->value != ''? $setting['title']->value.$title  : 'تكنو مصر للبرمجيات '.$title}}
    </title>
    <!-- Favicon
    <link rel="icon" href="favicon.ico" type="image/x-icon">-->
    <!-- Favicon -->
    @if($setting['fav']->value != null)
        <link rel="icon" href="{{ asset('storage/app/Settings/'.$setting['fav']->value) }}" type="image/x-icon"
        >
    @else
        <link rel="icon" href="{{ URL::to('/') }}/SiteAssets/style/images/logo.png" type="image/x-icon">

    @endif


<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/node-waves/waves.css" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/animate-css/animate.css" rel="stylesheet"/>

    <!-- Morris Chart Css-->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/morrisjs/morris.css" rel="stylesheet"/>

    <!-- JQuery DataTable Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
          rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>

    <!-- Sweetalert Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/sweetalert/sweetalert.css" rel="stylesheet"/>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
          rel="stylesheet"/>


    <!-- Custom Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/css/style-ar-custom.css" rel="stylesheet">


    <!-- SupervisorBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ URL::to('/') }}/AdminAssets/css/themes/sh-theme.css" rel="stylesheet"/>

    <!-- fileinput Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-fileinput/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>

    {{-- sweetalert2 --}}
    {{--<script src="{{ URL::to('/') }}/AdminAssets/sweetalert2/sweetalert2.min.js"></script>
    <link href="{{ URL::to('/') }}/AdminAssets/sweetalert2/sweetalert2.min.css" rel="stylesheet">
--}}
    @yield('new_style')
</head>

<body class="theme-teal">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader" dir="ltr">
            <div class="spinner-layer pl-teal">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>برجاء الإنتظار...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ URL::to('/SupervisorPanel') }}">
                {{$setting['title']->value != ''? $setting['title']->value  : 'تكنو مصر للبرمجيات '}}
                | لوحه تحكم الإداره
            </a>
        </div>


        <div class="collapse navbar-collapse" id="navbar-collapse">


            <ul class="nav navbar-nav navbar-left">
                <li class="pull-left">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

            <ul class="nav navbar-nav left" id="#notificationsList">
            {{--<a href="{{ URL::to('ChangeLanguage/ar') }}">ar</a>
            <a href="{{ URL::to('ChangeLanguage/en') }}">en</a>--}}
            <!-- Notifications -->

                <?php
                $notifications_unread = \App\Notification::where('receiver_id', '=', Auth::user()->id)
                    ->where('status', '=', 'unread')
                    ->where('sendto','=','admin')->orderBy('id', 'desc')->get();

                ?>

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="true">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">{{count($notifications_unread)}}</span>
                    </a>
                    <ul class="dropdown-menu scrollable-menu">
                        <li class="header text-muted"> الإشعارات <span>( {{count($notifications_unread)}} )</span>
                        </li>
                        <li class="body">
                            <ul class="menu">

                                @foreach($notifications_unread as $notification)
                                    <li>
                                        <a href="{{url('/SupervisorPanel/ReadNotification/'.$notification->id)}}"
                                           class="">
                                            <div class="menu-info">
                                                <h5 class="text-danger">{{$notification->content}}</h5>
                                                <p>
                                                    <i class="material-icons">access_time</i>
                                                    {{date(' h:m d-m-Y',strtotime($notification->created_at))}}
                                                </p>
                                            </div>

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{url('/SupervisorPanel/AllNotifications/')}}" class="header text-muted">كل
                                الإشعارات</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->

            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <a href="{{url('/SupervisorPanel/UpdateProfile/')}}">
                    <img src="{{ URL::to('/') }}/AdminAssets/images/user.png" width="48" height="48" alt="User"/>
                </a>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                </div>
                <div class="email">
                    {{Auth::user()->email}}
                </div>
                </a>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">menu</i>
                    <ul class="dropdown-menu pull-left">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>تسجيل الخروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
    @include('SupervisorPanel.layouts.SupervisorMenu')
    <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018 <a href="javascript:void(0);">
                    {{$setting['title']->value != ''? $setting['title']->value : 'تكنو مصر للبرمجيات '}}</a>.
            </div>
            <div class="version">
                <b>الإصدار : </b> 1.0.0
                <br>
                <b>تنفيذ : </b>
                <a href="http://technomasr.com" target="_blank">شركة تكنو مصر للبرمجيات</a>

            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>

<section class="content">

    @yield('content')
</section>

<!-- Jquery Core Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-slimscroll/jquery.slimscroll-ar.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/raphael/raphael.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/chartjs/Chart.bundle.js"></script>

<!-- TinyMCE -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/tinymce/tinymce.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- file input Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>


<!-- SweetAlert Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="{{ URL::to('/') }}/AdminAssets/js/admin.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/js/pages/tables/jquery-datatable.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/js/pages/ui/tooltips-popovers.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/js/pages/ui/dialogs.js"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/js/pages/widgets/infobox/infobox-2.js"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Autosize Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="{{ URL::to('/') }}/AdminAssets/js/pages/forms/basic-form-elements.js"></script>

<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<!-- Demo Js -->
<script src="{{ URL::to('/') }}/AdminAssets/js/demo.js"></script>

<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-fileinput/js/plugins/purify.min.js"
        type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="{{ URL::to('/') }}/AdminAssets/plugins/bootstrap-fileinput/js/fileinput.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script>
    @if($errors->has('ErrorMessage'))
    (function alert() {
        swal({
            type: 'error',
            title: 'عذراً',
            timer: 5000,
            confirmButtonText: 'حاول مره أخري',
            text: ('البريد الإلكتروني أو الرقم السري غير صحيح'),

        })
    })();

    @endif

            @if(session('Success') != '')
    (function alert() {
        swal({
            type: 'success',
            title: 'جيد ',
            //text: 'Something went wrong!',
            timer: 5000,
            confirmButtonText: 'الإستمرار',
            text: ('{{session('Success')}}'),
        })
    })();
    {{ session()->forget('Success') }}

            @endif

            @if(session('Faild') != '')
    (function alert() {
        swal({
            type: 'error',
            title: 'عذراً',
            timer: 5000,
            confirmButtonText: 'حاول مره أخري',
            text: ('{{session('Faild')}}'),
        })
    })();
    {{ session()->forget('Faild') }}

    @endif
</script>

@yield('script')

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#files-1").fileinput({'showUpload': false});
    });
</script>

<script type="text/javascript">
    /*//preview logo and favicon before uploading
    $("#LogoUpload").on('change', function () {

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#Logo-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image col-sm-12"
                    }).appendTo(image_holder);

                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
    $("#FavUpload").on('change', function () {

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#Fav-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image col-sm-12"
                    }).appendTo(image_holder);

                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
    $("#SocialPhotoUpload").on('change', function () {

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                var image_holder = $("#SocialPhoto-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image col-sm-12"
                    }).appendTo(image_holder);

                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });*/
    $(function () {
        //TinyMCE
        tinymce.init({
            selector: "textarea#tinymce",
            theme: "modern",
            height: 100,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true
        });
        tinymce.suffix = ".min";
        tinyMCE.baseURL = '{{ URL::to("/") }}/AdminAssets/plugins/tinymce';
    });
    //========================================================================================================
    $(document).on('ready', function () {
        $("#file-0b").fileinput();
    });
</script>
<?php if($Active == 'Sliders'){
// Slides & Opponents repeater Btn ?>
<script type="text/template" id="RepeatSlideTPL">
    <div class="More">
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 form-control-label m-b-0">
            <label for="Slides">الصورة</label>
            <div class="form-group">
                <div class="form-line @if($errors->has('Slides')) error @endif">
                    <input name="Slides[]" id="file-Slides1" class="file" type="file">
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 form-control-label m-b-0">
            <label for="SlideTxt">تفاصيل الصورة</label>
            <div class="form-group">
                <div class="form-line @if($errors->has('SlideTxt')) error @endif">
                    {{Form::text('SlideTxt[]','',array('class'=>'form-control'))}}
                </div>
                @if ($errors->has('SlideTxt'))
                    <label id="SlideTxt-error" class="error" for="SlideTxt">{{ $errors->first('SlideTxt') }}</label>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 form-control-label m-b-0">
            <label for="SlideUrl">رابط تفاصيل الصورة</label>
            <div class="form-group">
                <div class="form-line @if($errors->has('SlideUrl')) error @endif">
                    {{Form::text('SlideUrl[]','',array('class'=>'form-control'))}}
                </div>
                @if ($errors->has('SlideUrl'))
                    <label id="SlideUrl-error" class="error" for="SlideUrl">{{ $errors->first('SlideTxt') }}</label>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <span class="delete btn bg-red">
                        حذف الصورة
                    </span>
        </div>
        <div class="clearfix"></div>
    </div>
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var max_fields = 50;
        var wrapper = $(".repeatableSlides");
        var add_button = $(".add_Slide");
        var RepeatOpponentTPL = $("#RepeatSlideTPL").html();

        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append(RepeatOpponentTPL); //add input box
            } else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).closest('.More').remove();
            x--;
        })
    });
</script>
<?php }
//End of Slides & Opponents repeater Btn ?>


@yield('new_script')

</body>

</html>