@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            @if(isset($category))
                <li><a href="{{ URL::to('/AdminPanel/Categories') }}">إداره الأقسام</a></li>
                <li class="active">مقالات {{$category->name_ar}}</li>
            @else
                <li class="active">{{$PageTitle}}</li>
            @endif

        </ol>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        @if(isset($category))
                            <h2>مقالات {{$category->name_ar}}</h2>
                        @else
                            <h2>{{$PageTitle}}</h2>
                        @endif
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal">add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        @if(isset($category))
                                            <a href="{{ URL::to('/AdminPanel/Categories/'.$category->id.'/Articles/CreateArticle') }}">إضافه
                                                مقال جديد</a>
                                        @else
                                            <a href="{{ URL::to('/AdminPanel/Articles/CreateArticle') }}">إضافه مقال
                                                جديد</a>
                                        @endif
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
                                <th>عنوان المقال</th>
                                <th>وصف المقال</th>
                                <th> الزيارات</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>

                            @foreach($articles as $article)
                                <?php
                                if ($article->status == 'published') {
                                    $status = 'منشور';
                                    $color = 'bg-green';
                                } else {
                                    $status = 'مؤرشف';
                                    $color = 'bg-orange';
                                }


                                if ($article->isFeature == 1) {
                                    $feature = 'مميز';
                                    $feature_color = 'bg-purple';
                                } else {
                                    $feature = '';
                                    $feature_color = '';
                                }
                                ?>
                                <tr id="row_{{ $article->id }}">
                                    <td>{{$x}}</td>

                                    <td>
                                        {{$article->name_ar}}
                                        <div style="margin-top: 10px" class="">
                                            <span class="label {{$color}}" style="margin-right: 0">{{$status}}</span>
                                            <span class="label {{$feature_color}}"
                                                  style="margin-right: 0px !important;">{{$feature}}</span>
                                            <div class="clearfix"></div>
                                            <br>
                                            <span class="label bg-light-blue"
                                                  style="margin-right: 0px">
                                                    {{\App\Category::where('id','=',$article->category_id)->exists() ? $article->category->name_ar : 'تم حذف القسم'}}

                                            </span>
                                            <div class="clearfix"></div>
                                            <br>
                                            <span class="label bg-deep-purple"
                                                  style="margin-right: 0px !important;">{{date('Y - m - d' , strtotime($article->created_at))}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {!!   \Illuminate\Support\Str::limit($article->summary != '' ? $article->summary : html_entity_decode($article->description) , 200) !!}

                                    </td>
                                    <td>
                                        {{$article->visits}}

                                    </td>

                                    <td class="text-center">
                                        <?php
                                        if (isset($category)) {
                                            $baseLink = '/AdminPanel/Categories/' . $category->id;
                                        } else {
                                            $baseLink = '/AdminPanel';
                                        }
                                        ?>
                                        <a href="{{ URL::to($baseLink.'/Articles/'.$article->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل {{$article->name_ar}} "
                                           style="margin : 2px">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Articles/'.$article->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title=" حذف {{$article->name_ar}}"
                                                style="margin : 2px">
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