@extends('SupervisorPanel.layouts.SupervisorIndex')

@section('content')
    <div class="container-fluid">
        <!-- RealStates -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            كل الإشعارات
                        </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered  table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الإشعارات</th>
                                <th>التاريخ</th>

                                <th>الإجراءات</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $X = 1?>
                            @foreach($notifications as $notification)
                                <?php
                                if($notification->status=='unread'){
                                    $color='bg-orange';
                                    $status='غير مقرؤه';
                                    $txt_color='text-danger';

                                }else{
                                    $color='bg-green';
                                    $status=' مقرؤه';
                                    $txt_color='text-info';
                                }

                                ?>

                                <tr id="row_{{ $notification->id }}" class="{{$txt_color}}">
                                    <td>
                                        {{$X}}
                                    </td>
                                    <td>
                                        <a href="{{url('/SupervisorPanel/ReadNotification/'.$notification->id)}}" style="text-decoration: none;color: inherit">
                                            {{$notification->content}}
                                        </a>
                                        <span class="label {{$color}}" style="margin-right: 20px">{{$status}}</span>
                                    </td>
                                    <td>
                                        {{date(' h:m d-m-Y',strtotime($notification->created_at))}}
                                    </td>

                                    <td class="text-center">

                                        <button onclick="showConfirmMessage('{{ URL::to('/SupervisorPanel/delete_notification/'.$notification->id) }}')"
                                                class="btn bg-red waves-effect">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>

                                <?php $X ++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RealStates -->
    </div>

@stop