@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            <li class="active">{{$PageTitle}}</li>

        </ol>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{$PageTitle}}</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal">add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="{{ URL::to('/AdminPanel/Widgets/CreateWidget') }}">إضافه ودجت
                                            جديد</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان الودجت</th>
                                <th>نوع الودجت</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>

                            @foreach($widgets as $widget)
                                <?php
                                if ($widget->status == 'active') {
                                    $status = 'منشور';
                                    $color = 'bg-green';
                                } else {
                                    $status = 'مؤرشف';
                                    $color = 'bg-orange';
                                }

                                if ($widget->type == 'articles') {
                                    $type = 'قائمه مقالات';
                                } elseif ($widget->type == 'slider') {
                                    $type = 'إسلايدر مقالات';
                                } elseif ($widget->type == 'feature_article') {
                                    $type = 'مقال مميز';
                                } elseif ($widget->type == 'questionnaire') {
                                    $type = 'إستفتاء';
                                } else {
                                    $type = 'إعلان';
                                }

                                ?>
                                <tr id="row_{{ $widget->id }}">
                                    <td>{{$x}}</td>

                                    <td>
                                        {{$widget->name}}
                                        <div style="margin-top: 10px" class="">
                                            <span class="label {{$color}}" style="margin-right: 0">{{$status}}</span>
                                            <div class="clearfix"></div>
                                            <br>
                                            <span class="label bg-deep-purple"
                                                  style="margin-right: 0px !important;">{{date('Y - m - d' , strtotime($widget->created_at))}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{$type}}
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ URL::to('/AdminPanel/Widgets/'.$widget->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل {{$widget->name}} "
                                           style="margin : 2px">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Widgets/'.$widget->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title=" حذف {{$widget->name}}"
                                                style="margin : 2px">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $x++?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Users -->
    </div>
@stop