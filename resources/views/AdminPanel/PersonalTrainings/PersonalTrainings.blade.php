@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            <li class="active">{{$PageTitle}}</li>

        </ol>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$PageTitle}}
                        </h2>

                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>بيانات التواصل</th>
                                <th>محتوي الرساله</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $X = 1 ?>
                            @foreach($forms as $form)
                                <?php


                                if($form->Status =='Unread'){
                                    $Status='غير مقرؤه';
                                    $StatusColor='bg-orange';
                                }else{
                                    $Status='مقرؤه';
                                    $StatusColor='bg-green';
                                }

                                ?>

                                <tr id="row_{{$form->id}}">
                                    <td>
                                        {{$X}}
                                    </td>
                                    <td>
                                        <p>
                                            <span>الإسم :</span>
                                            <span class=" col-pink">
                                            {{$form->PersonName}}
                                            </span>
                                        </p>
                                        <p style="margin-top: 5px;margin-bottom: 5px">
                                            <span>رقم الهاتف : </span>
                                            <span class=" col-pink">
                                                {{$form->Mobile}}
                                            </span>
                                        </p>
                                        <p style="margin-top: 5px;margin-bottom: 5px">
                                            <span>البريد الإلكتروني : </span>
                                            <span class=" col-pink">
                                                {{$form->Email}}
                                            </span>
                                        </p>
                                        <div style="margin-top: 15px">
                                            <span class="label {{$StatusColor}}" style="margin-left: 20px">{{$Status}}</span>
                                            <span class="label bg-light-blue">
                                            {{date('d-m-Y',strtotime($form->created_at)) }}
                                        </span>

                                        </div>
                                    </td>
                                    <td>
                                        {!! \Illuminate\Support\Str::limit( $form->msg , 250) !!}

                                    </td>

                                    <td class="text-center">
                                        <a href="{{ URL::to('/AdminPanel/PersonalTrainings/'.$form->id.'/View') }}"
                                           class="btn bg-light-blue waves-effect">
                                            <i class="material-icons">clear_all</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/PersonalTrainings/'.$form->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $X++ ?>
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