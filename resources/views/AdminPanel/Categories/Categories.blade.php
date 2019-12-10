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
                                    <li><a href="{{ URL::to('/AdminPanel/Categories/CreateCategory') }}">إضافه قسم
                                            جديد</a>
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
                                <th>إسم القسم</th>
                                <th>إجمالي المقالات</th>
                                <th>الزيارات</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $X = 1 ?>
                            @foreach($categories as $category)
                                <?php
                                if ($category->status == 'published') {
                                    $status = 'منشور';
                                    $color = 'bg-green';
                                } else {
                                    $status = 'مؤرشف';
                                    $color = 'bg-orange';
                                }

                                if ($category->category_id == null) {
                                    $parent_text = 'قسم رئيسي';
                                    $parent_color = 'bg-pink';
                                } else {
                                    $parent_text = $category->category->name;
                                    $parent_color = 'bg-purple';
                                }

                                if ($category->isFeature == 1) {
                                    $feature = 'مميز';
                                    $feature_color = 'bg-light-blue';
                                } else {
                                    $feature = '';
                                    $feature_color = '';
                                }

                                $cateIDs = [];
                                array_push($cateIDs, $category->id);
                                $parents = \App\Category::where('category_id', '=', $category->id)
                                    ->get()->pluck('id')->toArray();
                                if (count($parents) != 0) {
                                    array_push($cateIDs, $parents);
                                }
                                ?>

                                <tr id="row_{{ $category->id }}">
                                    <td>{{$X}}</td>
                                    <td>{{ $category->name_ar }}
                                        <p style="margin-top: 10px">
                                            <span class="label {{$color}}">{{$status}}</span>
                                            <span class="label {{$parent_color}}"
                                                  style="margin-right: 10px">{{$parent_text}}</span>
                                            <span class="label {{$feature_color}}"
                                                  style="margin-right: 10px">{{$feature}}</span>
                                        </p>
                                    </td>
                                    <td>{{\App\Article::whereIn('category_id',$cateIDs)->get()->count()}}</td>
                                    <td>{{$category->visits}}</td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('/AdminPanel/Categories/'.$category->id.'/Articles') }}"
                                           class="btn bg-light-blue waves-effect" data-toggle="tooltip"
                                           data-placement="top" title=" مقالات {{$category->name}}">
                                            <i class="material-icons">list</i>
                                        </a>

                                        <a href="{{ URL::to('/AdminPanel/Categories/'.$category->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Categories/'.$category->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف">
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