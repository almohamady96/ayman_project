@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Emails/All') }}">إدراه الرسائل</a></li>
        <li class="active">رساله جديده</li>
    </ol>

    {!! Form::open(['files'=>true,'url'=>'/AdminPanel/Emails/CreateEmail' ,'method'=>'post']) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إرسال رساله جديده
                        <small>املأ البيانات التالية </small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-8">
                            <h2 class="card-inside-title">عنوان الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('title')) error @endif">
                                    {{ Form::text('title','',array('id'=>'title','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('title'))
                                    <label id="title-error" class="error" for="title">{{ $errors->first('title') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">إرسال إلي</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('type')) error @endif">
                                    {{ Form::select('type' ,[
                                                               'users' => ' الأعضاء',
/*                                                               'subscribes' => ' القائمه البريديه',
                                                               'all' => ' القائمه البريديه والأعضاء',*/
                                                               ],'users',
                                                               array('id'=>'type','class'=>'form-control show-tick' ,
                                                                                        )) }}
                                </div>
                                @if ($errors->has('type'))
                                    <label id="title-error" class="error" for="title">{{ $errors->first('type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">محتوي الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('content')) error @endif">
                                    {{ Form::textarea('content','',array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('content'))
                                    <label id="details-error" class="error" for="details">{{ $errors->first('content') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        {{--<div class="clearfix"></div>
--}}

                    </div>
                    {{ Form::submit('إرسال',array('class'=>'btn bg-teal waves-effect')) }}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop