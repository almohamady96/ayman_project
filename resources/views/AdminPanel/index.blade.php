@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">

        <!-- Widgets -->
        <div class="row clearfix">

            <div class="block-header">
                <h2>إحصائيات مهمه </h2>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $todayVisitors = \App\Visit::where('day', '=', date('d'))
                        ->where('month', '=', date('m'))
                        ->where('year', '=', date('Y'))
                        ->distinct('session_id')
                        ->pluck('session_id')
                        ->count();
                    ?>
                    <div class="content">
                        <div class="text"> زائرين يوم {{date('d-m-Y')}}</div>
                        <div class="number count-to" data-from="0" data-to="{{$todayVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$todayVisitors}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">notifications</i>
                    </div>
                    <?php
                    $unreadNotes = \App\Notification::where('receiver_id', '=', Auth::user()->id)
                        ->where('status', '=', 'unread')
                        ->where('sendto', '=', 'admin')->orderBy('id', 'desc')->get()->count();
                    ?>
                    <div class="content">
                        <div class="text">إشعارات غير مقرؤه</div>
                        <div class="number count-to" data-from="0" data-to="{{$unreadNotes}}" data-speed="1000"
                             data-fresh-interval="20">{{$unreadNotes}}</div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="block-header">
                <h2>إحصائيات عامه </h2>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">group</i>
                    </div>
                    <?php
                    $users = \App\User::all()->count();
                    ?>
                    <div class="content">
                        <div class="text">كل الأعضاء</div>
                        <div class="number count-to" data-from="0" data-to="{{$users}}" data-speed="1000"
                             data-fresh-interval="20">{{$users}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">dashboard</i>
                    </div>
                    <?php
                    $adminCategories = \App\Category::all();
                    ?>
                    <div class="content">
                        <div class="text">إجمالي الأقسام</div>
                        <div class="number count-to" data-from="0" data-to="{{count($adminCategories)}}" data-speed="1000"
                             data-fresh-interval="20">{{count($adminCategories)}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">edit</i>
                    </div>
                    <?php
                    $adminArticles  =\App\Article::orderBy('id', 'desc')
                        ->get();

                    ?>
                    <div class="content">
                        <div class="text">إجمالي المقالات </div>
                        <div class="number count-to" data-from="0" data-to="{{count($adminArticles)}}" data-speed="1000"
                             data-fresh-interval="20">{{count($adminArticles)}}</div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="block-header">
                <h2>إحصائيات الزائرين </h2>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $today = date('d-m-Y');
                    $weekStart = strtotime("previous saturday");
                    $weekEnd = strtotime("next saturday");

                    $weekVisitors = \App\Visit::whereBetween('created_at', [date('Y-m-d h:m:s', $weekStart), date('Y-m-d h:m:s', $weekEnd)])
                        ->distinct('session_id')->pluck('session_id')->count();
                    ?>
                    <div class="content">
                        <div class="text">زائرين هذا الأسبوع</div>
                        <div class="number count-to" data-from="0" data-to="{{$weekVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$weekVisitors}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $monthVisitors = \App\Visit::where('month', '=', date('m'))
                        ->where('year', '=', date('Y'))
                        ->distinct('session_id')->pluck('session_id')->count();
                    ?>
                    <div class="content">
                        <div class="text">زائرين شهر {{date('F')}}</div>
                        <div class="number count-to" data-from="0" data-to="{{$monthVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$monthVisitors}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $previousMonth = date('F', strtotime('-1 month', strtotime(date('F'))));
                    $prev = date('m', strtotime($previousMonth));
                    $prevMonthVisitors = \App\Visit::where('month', '=', $prev)
                        ->where('year', '=', date('Y'))
                        ->distinct('session_id')->pluck('session_id')->count();

                    ?>
                    <div class="content">
                        <div class="text">زائرين شهر {{$previousMonth}}</div>
                        <div class="number count-to" data-from="0" data-to="{{$prevMonthVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$prevMonthVisitors}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-teal hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $yearVisitors = \App\Visit::where('year', '=', date('Y'))
                        ->distinct('session_id')->pluck('session_id')->count();
                    ?>
                    <div class="content">
                        <div class="text"> زائرين سنه {{date('Y')}}</div>
                        <div class="number count-to" data-from="0" data-to="{{$yearVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$yearVisitors}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <?php
                    $allVisitors = \App\Visit::distinct('session_id')->pluck('session_id')->count();
                    ?>
                    <div class="content">
                        <div class="text">إجمالي الزائرين</div>
                        <div class="number count-to" data-from="0" data-to="{{$allVisitors}}" data-speed="1000"
                             data-fresh-interval="20">{{$allVisitors}}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop