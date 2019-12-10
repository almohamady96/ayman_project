@extends('AdminPanel.layouts.AdminIndex')

@section('content')
            <!-- Videos -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                إدارة الفيديوهات
                                <a href="{{ URL::to('/AdminPanel/Videos/New') }}" class="btn btn-sm pull-left btn-danger">إضافة فيديو جديد</a>
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان الفيديو</th>
                                        <th>الصورة الرئيسية</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان الفيديو</th>
                                        <th>الصورة الرئيسية</th>
                                        <th>{{ trans('Site.Tools') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $X = 1; ?>
                                    @foreach($Videos as $Video)
                                        <tr id="row_{{ $Video->id }}">
                                            <td><?php echo $X; $X++; ?></td>
                                            <td>
                                                <ul>
                                                    <li>{{ $Video->VideoTitle_ar }}</li>
                                                    <li>{{ $Video->VideoTitle_en }}</li>
                                                </ul>
                                            </td>
                                            <td style="max-width:200px;">
                                                @if($Video->VideoPhoto != '')
                                                    <img src="{{ asset('storage/app/public/Videos/'.$Video->id.'/'.$Video->VideoPhoto) }}" style="max-height:60px;">
                                                @else
                                                    <img src="https://img.youtube.com/vi/{{ $Video->VideoCode }}/0.jpg" style="max-height:60px;">
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ URL::to('/AdminPanel/Videos/'.$Video->id.'/Edit') }}" class="btn btn-info waves-effect">
                                                    <i class="material-icons">settings</i>
                                                </a>
                                                <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Videos/'.$Video->id.'/Delete') }}')" class="btn btn-danger waves-effect">
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
            <!-- #END# Videos -->
@stop