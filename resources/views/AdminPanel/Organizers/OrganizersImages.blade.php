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
                                        <a href="{{ URL::to('/AdminPanel/Organizers/CreateOrganizerImage') }}">منظم إداري جديد</a>
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
                                <th>بيانات الصوره</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>
                            @foreach($images as $image)
                                <tr id="row_{{ $image->id }}">
                                    <td>{{$x}}</td>
                                    <td>
                                        <p>
                                            <a href="{{$image->name}}">اضغط هنا للدخول إلى الرابط الخارجى</a>
                                        </p>
                                        <a href="{{URL::to('storage/app/organizers/' . $image->id . '/' . $image->file)}}" target="_blank">
                                            <img src="{{URL::to('storage/app/organizers/' . $image->id . '/' . $image->file)}}"
                                            style="max-width: 400px;max-height: 100px">
                                        </a>

                                    </td>
                                    <td class="text-center">

                                            <a href="{{ URL::to('/AdminPanel/Organizers/'.$image->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل" style="margin: auto">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Organizers/'.$image->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف "  style="margin: auto">
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