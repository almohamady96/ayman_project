@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>

        <li class="active"> إداره الرسائل</li>
    </ol>
    <div class="container-fluid">
        <!-- RealStates -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            إدراه الرسائل
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal" >add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="{{ URL::to('/AdminPanel/Emails/CreateEmail') }}">إرسال رساله جديده</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>العنوان</th>
                                <th>الرساله</th>
                                <th>البريد الإلكتروني</th>

                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            {{--<tfoot>
                            <tr>
                                <th>#</th>
                                <th>العنوان</th>
                                <th>البريد الإلكتروني</th>
                                <th>الرساله</th>
                                <th>النوع</th>
                                <th>الإجراءات</th>

                            </tr>
                            </tfoot>--}}
                            <tbody>
                            <?php $X = 1; ?>
                            @foreach($messages as $message)
                                <tr id="row_{{ $message->id }}">
                                    <td>
                                        {!!  $X !!}
                                    </td>
                                    <td>
                                        {!!  $message->title !!}
                                        <p style="margin-top: 5px;margin-bottom: 5px">
                                            <span>إلي : </span>
                                            <span class=" col-pink">
                                        @if($message->type == 'users')
                                                    <span>الأعضاء</span>
                                                @elseif($message->type == 'subscribes')
                                                    <span>القائمه البريديه</span>
                                                @else
                                                    <span>القائمه البريديه و الأعضاء</span>
                                                @endif
                                            </span>
                                        </p>
                                        <p class="col-teal">
                                            {{date('d-m-Y ' , strtotime($message->created_at))}}
                                        </p>


                                    </td>
                                    <td>
                                        {!! \Illuminate\Support\Str::limit( $message->content , 100) !!}

                                    </td>
                                    <td>
                                        {{$message->email}}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ URL::to('/AdminPanel/Emails/ViewEmail/'.$message->id) }}"
                                           class="btn bg-light-blue waves-effect">
                                            <i class="material-icons"
                                               data-toggle="tooltip"
                                               data-placement="top" title="تفاصيل الرساله">clear_all</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Emails/DeleteEmail/'.$message->id) }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف ">
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