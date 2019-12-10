@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Quotes') }}">آراء الأعضاء في تكنو مصر</a></li>
        <li class="active"> إضافه رأي جديد</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه رأي جديد
                        <small>يمكنك إضافه رأي العضو و بياناته من هنا</small>

                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الصوره </h2>

                            <div class="form-group">
                                <div class="form-line @if($errors->has('image_file')) error @endif">
                                    <input id="file-photos" required class="file" name="image_file" type="file">
                                </div>
                                @if ($errors->has('image_file'))
                                    <label id="image_file-error" class="error"
                                           for="image_file">{{ $errors->first('image_file') }}</label>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">إسم العضو</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('uName')) error @endif">
                                    {{ Form::text('uName','',array('required'=>true,'id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                </div>
                                @if ($errors->has('uName'))
                                    <label id="uName-error" class="error"
                                           for="uName">{{ $errors->first('uName') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">وظيفه العضو</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('uJobTitle')) error @endif">
                                    {{ Form::text('uJobTitle','',array('id'=>'','class'=>'form-control', 'placeholder'=>' ')) }}
                                </div>
                                @if ($errors->has('uJobTitle'))
                                    <label id="uJobTitle-error" class="error"
                                           for="uJobTitle">{{ $errors->first('uJobTitle') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">رأي العضو<span
                                        class="small text-muted"></span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('quote_content')) error @endif">
                                    {{ Form::textarea('quote_content','',array('rows'=>5,'class'=>'form-control', 'placeholder'=>'')) }}
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