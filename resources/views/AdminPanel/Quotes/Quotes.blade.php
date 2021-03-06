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
                                        <a href="{{ URL::to('/AdminPanel/Quotes/CreateQuote') }}">إضافه رأي جديد
                                        </a>
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
                                <th>الرأي</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>

                            @foreach($quotes as $quote)
                                <?php

                                if ($quote->status == 'unread') {
                                    $new = 'جديد';
                                    $newColor = 'bg-pink';
                                } else {
                                    $new = '';
                                    $newColor = '';
                                }
                                if ($quote->isAccepted == 1) {
                                    $status = 'تم الموافقه علي نشره';
                                    $color = 'bg-green';
                                } else {
                                    $status = 'لم يتم الموافقه علي نشره';
                                    $color = 'bg-orange';
                                }
                                ?>

                                <tr id="row_{{ $quote->id }}">
                                    <td>{{$x}}</td>

                                    <td>
                                        {{$quote->content}}
                                        <p style="margin-top: 10px" class="text-center">
                                        <div class="row m-b-10">
                                            <span class="label {{$newColor}}" style="margin: auto">{{$new}}</span>
                                            <span class="label {{$color}}" style="margin: auto">{{$status}}</span>
                                            <span class="label bg-deep-purple"
                                                  style="margin: auto">{{date('Y - m - d' , strtotime($quote->created_at))}}</span>

                                        </div>
                                        </p>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ URL::to('/AdminPanel/Quotes/'.$quote->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل   ">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Quotes/'.$quote->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف  ">
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