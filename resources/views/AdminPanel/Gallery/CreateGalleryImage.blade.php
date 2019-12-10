@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Gallery/') }}">إدارة معرض الصور </a></li>
        <li class="active"> إضافه صوره جديده</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه صوره جديده
                        <small>املأ البيانات بالأسفل لإضافه الصوره</small>

                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-9">
                            <h2 class="card-inside-title">إسم الصوره </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('image_name')) error @endif">
                                    {{ Form::text('image_name','',array('id'=>'image_name','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('image_name'))
                                    <label id="image_name-error" class="error"
                                           for="image_name">{{ $errors->first('image_name') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h2 class="card-inside-title">ترتيب ظهور الصوره <span class="small"> </span>
                            </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('number')) error @endif">
                                    {{ Form::number('number','',array('min'=>1,'id'=>'number','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('number'))
                                    <label id="number-error" class="error"
                                           for="number">{{ $errors->first('number') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-sm-6">
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
                        <div class="clearfix"></div>
                    </div>
                    {{ Form::submit('حفظ',array('value'=>'حفظ','class'=>'btn bg-teal waves-effect')) }}


                </div>
            </div>
        </div>
    </div>


    {!! Form::close() !!}

@stop