@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Emails/All') }}">إدراه الرسائل</a></li>
        <li class="active">عرض رساله</li>
    </ol>

   {{-- {!! Form::open(['files'=>true,'url'=>'/AdminPanel/Emails/CreateEmail' ,'method'=>'post']) !!}
   --}}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        عرض رساله
                        <small>تفاصيل الرساله </small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">عنوان الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('title')) error @endif">
                                    <input type="text" value="{{$message->title}}" disabled="" class="form-control">
                                </div>
                                @if ($errors->has('title'))
                                    <label id="title-error" class="error" for="title">{{ $errors->first('title') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <h2 class="card-inside-title">المٌرسِل </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('from')) error @endif">
                                    <input type="text" value="{{$message->from}}" disabled="" class="form-control">
                                </div>
                                @if ($errors->has('from'))
                                    <label id="from-error" class="error" for="from">{{ $errors->first('from') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <h2 class="card-inside-title">المٌرسل إليه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('email')) error @endif">
                                    <input type="text" value="{{$message->email}}" disabled="" class="form-control">
                                </div>
                                @if ($errors->has('email'))
                                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">محتوي الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('content')) error @endif">

                                    {!! $message->content	 !!}

                                </div>
                                @if ($errors->has('content'))
                                    <label id="details-error" class="error" for="details">{{ $errors->first('content') }}</label>
                                @endif
                            </div>
                        </div>



                        {{--<div class="clearfix"></div>
--}}

                    </div>
                   {{-- {{ Form::submit('إرسال',array('class'=>'btn bg-teal waves-effect')) }}
              --}}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop