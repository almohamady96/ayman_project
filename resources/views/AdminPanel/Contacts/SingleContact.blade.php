@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Contacts') }}">إدراه نماذج إتصل بنا</a></li>
        <li class="active">{{$PageTitle}}</li>
    </ol>

    {{-- {!! Form::open(['files'=>true,'url'=>'/AdminPanel/Emails/CreateEmail' ,'method'=>'post']) !!}
    --}}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$PageTitle}}
                        <small></small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإسم</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{$form->name}}</p>
                                </div>
                                @if ($errors->has(''))
                                    <label id="-error" class="error" for="">{{ $errors->first('') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">رقم الهاتف</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                <p>{{$form->mobile}}</p>
                                </div>
                                @if ($errors->has(''))
                                    <label id="-error" class="error" for="">{{ $errors->first('') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">البريد الإلكتروني</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                  <p>{{$form->email}}</p>
                                </div>
                                @if ($errors->has(''))
                                    <label id="-error" class="error" for="">{{ $errors->first('') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <h2 class="card-inside-title">التاريخ</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{date('d-m-Y',strtotime($form->created_at))}}</p>
                                </div>
                                @if ($errors->has(''))
                                    <label id="-error" class="error" for="">{{ $errors->first('') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">محتوي الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p style="margin-top: 15px;margin-bottom: 15px">{!! html_entity_decode($form->content) !!}</p>
                                </div>
                                @if ($errors->has('content'))
                                    <label id="-error" class="error" for="">{{ $errors->first('') }}</label>
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