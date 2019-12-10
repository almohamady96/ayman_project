@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            <li><a href="{{ URL::to('/AdminPanel/Courses') }}"> الدورات</a></li>
            @if(!isset($chapter))
                <li class="active">أسئله دوره {{\Illuminate\Support\Str::limit($course->name , 20)}}</li>
            @else
                <li><a href="{{ URL::to('Products'.$course->id.'/Chapters') }}"> مستويات
                        دوره {{\Illuminate\Support\Str::limit($course->name , 20)}}</a></li>
                <li class="active">أسئله {{\Illuminate\Support\Str::limit($chapter->name , 20)}}</li>
            @endif

        </ol>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            @if(isset($chapter))
                                أسئله مستوي {{\Illuminate\Support\Str::limit($chapter->name, 20)}}
                            @else
                                أسئله دوره {{\Illuminate\Support\Str::limit($course->name, 20)}}
                            @endif
                        </h2>
                        @if(isset($chapter))
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal">add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="{{ URL::to('/AdminPanel/Courses/'.$course->id.'/Chapters/'.$chapter->id.'/Questions/CreateQuestion') }}">سؤال
                                            جديد</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                            @endif
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نص السؤال</th>
                                <th>الدرجه</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>
                            @foreach($questions as $question)
                                <?php
                                if ($question->answer_type == 'image') {
                                    $type = 'الإجابات صور';
                                    $typeColor = 'bg-pink';
                                } elseif ($question->answer_type == 'audio') {
                                    $type = 'الإجابات مقاطع صوتيه';
                                    $typeColor = 'bg-purple';
                                } else {
                                    $type = 'إلإجابات نصوص كتابيه';
                                    $typeColor = 'bg-light-blue';
                                }

                                ?>
                                <tr id="row_{{ $question->id }}">
                                    <td>{{$x}}</td>
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($question->q,80)   }}
                                        <div style="margin-top: 15px">
                                            <span class="label {{$typeColor}}">{{$type}}</span>
                                            <span class="label bg-light-green">{{$question->chapter->name}}</span>
                                        </div>
                                    </td>
                                    <td>{{$question->degree}}</td>
                                    <td class="text-center">

                                        <a href="{{ URL::to('/AdminPanel/Courses/'.$course->id.'/Chapters/'.$question->chapter_id.'/Questions/'.$question->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل السؤال ">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Courses/'.$course->id.'/'.$question->chapter_id.'/Questions/'.$question->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف السؤال ">
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