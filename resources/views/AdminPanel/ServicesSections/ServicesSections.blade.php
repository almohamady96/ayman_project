@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">رئيسية لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Services') }}">إدارة الدورات التدريبية</a></li>
        <li class="active">إدارة أقسام الدورات التدريبية</li>
    </ol>
            <!-- ServicesSections -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                إدارة أقسام الدورات التدريبية
                                <a href="{{ URL::to('/AdminPanel/ServicesSections/NewServiceSection') }}" class="btn btn-sm pull-left btn-danger">إضافة قسم جديد</a>
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة القسم</th>
                                        <th>اسم القسم بالعربية</th>
                                        <th>اسم القسم بالإنجليزى</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة القسم</th>
                                        <th>اسم القسم بالعربية</th>
                                        <th>اسم القسم بالإنجليزى</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $X = 1; ?>
                                    @foreach($ServicesSections as $ServiceSection)
                                        <tr id="row_{{ $ServiceSection->id }}">
                                            <td><?php echo $X; $X++; ?></td>
                                            <td>
                                                @if($ServiceSection->photo != '')
                                                    <img src="{{ asset('storage/app/public/ServicesSections/'.$ServiceSection->id.'/'.$ServiceSection->photo) }}" height="60px;">
                                                @else
                                                    بدون صورة
                                                @endif
                                            </td>
                                            <td>{{ $ServiceSection->Title_ar }}</td>
                                            <td>{{ $ServiceSection->Title_en }}</td>
                                            <td class="text-center">
                                                <a href="{{ URL::to('/AdminPanel/ServicesSections/'.$ServiceSection->id.'/Edit') }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">settings</i>
                                                </a>
                                                <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/ServicesSections/'.$ServiceSection->id.'/Delete') }}')" class="btn btn-danger waves-effect">
                                                    <i class="material-icons">delete_forever</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# ServicesSections -->
@stop