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
                        <h2>
                            {{$PageTitle}}
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal">add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li><a href="{{ URL::to('/AdminPanel/Questionnaires/CreateQuestionnaire') }}">إضافه إستفتاء جديد </a>
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
                                <th>تفاصيل الإستفتاء</th>
                                <th>ميعاد الإنتهاء</th>
                                <th>نتيجه الإستفتاء</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $X = 1 ?>
                            @foreach($questionnaires as $questionnaire)
                                <?php
                                if ($questionnaire->status == 'active') {
                                    $status = 'نشط';
                                    $color = 'bg-green';
                                } else {
                                    $status = 'غير نشط';
                                    $color = 'bg-red';
                                }

                                ?>
                                <tr id="row_{{ $questionnaire->id }}">
                                    <td>{{$X}}</td>
                                    <td>
                                        {{ $questionnaire->q }}
                                        <div style="margin-top: 10px" class="">
                                            <span class="label {{$color}}" style="margin-right: 0">{{$status}}</span>
                                            <span class="label bg-deep-purple"
                                                  style="margin-right: 0px !important;">{{date('Y - m - d' , strtotime($questionnaire->created_at))}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $questionnaire->expireDate}}
                                    </td>
                                    <td>
                                        ---
                                    </td>


                                    <td class="text-center">
                                        <a href="{{ URL::to('/AdminPanel/Questionnaires/'.$questionnaire->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل الإستفتاء">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Questionnaires/'.$questionnaire->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف الإستفتاء">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $X++?>
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