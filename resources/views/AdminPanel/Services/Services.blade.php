@extends('AdminPanel.layouts.AdminIndex')

@section('content')
            <!-- Services -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                إدارة الدورات التدريبية
                                <a href="{{ URL::to('/AdminPanel/Services/NewService') }}" class="m-r-10 btn btn-sm pull-left btn-danger">إضافة خدمة جديدة</a>
                                <a href="{{ URL::to('/AdminPanel/ServicesSections') }}" class="btn btn-sm pull-left btn-primary">إدارة أقسام الدورات التدريبية</a>
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة الدورة التدريبية</th>
                                        <th>اسم الدورة التدريبية بالعربية</th>
                                        <th>اسم الدورة التدريبية بالإنجليزى</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>صورة الدورة التدريبية</th>
                                        <th>اسم الدورة التدريبية بالعربية</th>
                                        <th>اسم الدورة التدريبية بالإنجليزى</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $X = 1; ?>
                                    @foreach($Services as $Service)
                                        <tr id="row_{{ $Service->id }}">
                                            <td><?php echo $X; $X++; ?></td>
                                            <td>
                                                @if($Service->photo != '')
                                                    <img src="{{ asset('storage/app/public/Services/'.$Service->id.'/'.$Service->photo) }}" height="60px;">
                                                @else
                                                    بدون صورة
                                                @endif
                                            </td>
                                            <td>{{ $Service->Title_ar }}</td>
                                            <td>{{ $Service->Title_en }}</td>
                                            <td class="text-center">
                                                <a href="{{ URL::to('/AdminPanel/Services/'.$Service->id.'/Edit') }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">settings</i>
                                                </a>
                                                <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Services/'.$Service->id.'/Delete') }}')" class="btn btn-danger waves-effect">
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
            <!-- #END# Services -->
@stop