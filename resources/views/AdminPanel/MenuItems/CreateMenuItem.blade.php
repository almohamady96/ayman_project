@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Countries/') }}">إداره الدول</a></li>
        <li class="active"> إضافه دوله جديده</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه دوله جديده
                        <small>املأ البيانات بالأسفل لإضافه دوله جديده</small>

                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-8">
                            <h2 class="card-inside-title">إسم الدوله </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('country_name')) error @endif">
                                    {{ Form::text('country_name','',array('required'=>true,'id'=>'country_name','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('country_name'))
                                    <label id="country_name-error" class="error"
                                           for="country_name">{{ $errors->first('country_name') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            {{ Form::submit('حفظ',array('value'=>'حفظ','class'=>'btn bg-teal waves-effect')) }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {!! Form::close() !!}

@stop