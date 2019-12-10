@extends('SupervisorPanel.layouts.SupervisorIndex')

@section('content')
    <div class="container-fluid">
        <!-- RealStates -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            إداره السجل
                        </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered  table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>النشاط</th>
                                <th>التاريخ</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php $X = 1?>
                            @foreach($logs as $log)
                                <?php
                                if($log->status=='unread'){
                                    $color='bg-orange';
                                    $status='غير مقرؤه';
                                    $txt_color='text-danger';

                                }else{
                                    $color='bg-green';
                                    $status=' مقرؤه';
                                    $txt_color='text-info';
                                }          ?>
                                <tr id="row_{{ $log->id }}" class="{{$txt_color}}">
                                    <td>
                                        {{$X}}
                                    </td>
                                    <td>
                                        <a href="{{url('/SupervisorPanel/ReadLogNotification/'.$log->id)}}" style="text-decoration: none;color: inherit">
                                            {!! html_entity_decode($log->content) !!}
                                        </a>
                                        <span class="label {{$color}}" style="margin-right: 20px">{{$status}}</span>
                                    </td>
                                    <td>
                                        {{date(' h:m d-m-Y',strtotime($log->created_at))}}
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