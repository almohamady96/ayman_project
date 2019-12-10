@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Quotes') }}">آراء عملائنا</a></li>
        <li class="active"> تعديل رأي {{$quote->user_id != '' ? $quote->user->name : $quote->name}}</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        تعديل رأي {{$quote->user_id != '' ? $quote->user->name : $quote->name}}
                        <small>يمكنك تعديل رأي والموافقه علي نشره من هنا</small>

                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        @if($quote->user_id != '')
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">إسم</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('')) error @endif">
                                        {{ Form::text('',$quote->user->name,array('disabled'=>'true','id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                    </div>
                                    @if ($errors->has(''))
                                        <label id="-error" class="error"
                                               for="">{{ $errors->first('') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">وظيفه</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('')) error @endif">
                                        {{ Form::text('',$quote->user->jobTitle,array('disabled'=>'true','id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                    </div>
                                    @if ($errors->has(''))
                                        <label id="-error" class="error"
                                               for="">{{ $errors->first('') }}</label>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">إسم</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('uName')) error @endif">
                                        {{ Form::text('uName',$quote->name,array('required'=>true,'id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                    </div>
                                    @if ($errors->has('uName'))
                                        <label id="uName-error" class="error"
                                               for="uName">{{ $errors->first('uName') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">وظيفه</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('uJobTitle')) error @endif">
                                        {{ Form::text('uJobTitle',$quote->jobTitle,array('id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                    </div>
                                    @if ($errors->has('uJobTitle'))
                                        <label id="uJobTitle-error" class="error"
                                               for="uJobTitle">{{ $errors->first('uJobTitle') }}</label>
                                    @endif
                                </div>
                            </div>

                        @endif
                        <div class="col-sm-4">

                            <h2 class="card-inside-title">الموافقه علي نشر رأي العميل ؟</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('isAccepted')) error @endif">
                                    {{ Form::select('isAccepted',[
                                                                '1'=>'نعم',
                                                                '0'=>'لا',
                                                                ],$quote->isAccepted,array('id'=>'isAccepted','class'=>'form-control show-tick')) }}
                                </div>
                                @if ($errors->has('isAccepted'))
                                    <label id="isAccepted-error" class="error"
                                           for="isAccepted">{{ $errors->first('isAccepted') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">رأي في تكنو<span
                                        class="small text-muted"></span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('quote_content')) error @endif">
                                    {{ Form::textarea('quote_content',$quote->content,array('rows'=>5,'class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('quote_content'))
                                    <label id="quote_content-error" class="error"
                                           for="quote_content">{{ $errors->first('quote_content') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    {{ Form::submit('حفظ',array('value'=>'حفظ','class'=>'btn bg-teal waves-effect')) }}

                </div>


            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop