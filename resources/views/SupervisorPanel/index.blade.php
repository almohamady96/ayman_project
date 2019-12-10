@extends('SupervisorPanel.layouts.SupervisorIndex')

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

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">dashboard</i>
                    </div>
                    <?php
                    $supervisorCategories = unserialize(base64_decode(Auth::user()->categories));
                    ?>
                    <div class="content">
                        <div class="text">إجمالي الأقسام التي تشرف عليها</div>
                        <div class="number count-to" data-from="0" data-to="{{count($supervisorCategories)}}" data-speed="1000"
                             data-fresh-interval="20">{{count($supervisorCategories)}}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue-grey hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">edit</i>
                    </div>
                    <?php
                    $supervisorArticles  =\App\Article::whereIn('category_id', $supervisorCategories)
                        ->orderBy('id', 'desc')
                        ->get();

                    ?>
                    <div class="content">
                        <div class="text">إجمالي المقالات التي تشرف عليها</div>
                        <div class="number count-to" data-from="0" data-to="{{count($supervisorArticles)}}" data-speed="1000"
                             data-fresh-interval="20">{{count($supervisorArticles)}}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop