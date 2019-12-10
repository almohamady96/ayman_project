@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Menus/') }}">إداره القوائم</a></li>
        <li class="active">{{$menu->name}}</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        تعديل قائمه {{$menu->name}}
                        <small>املأ البيانات بالأسفل لتعديل القائمه</small>

                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-6">
                            <h2 class="card-inside-title">عنوان القائمه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('menu_name')) error @endif">
                                    {{ Form::text('menu_name',$menu->name,array('required'=>true,'id'=>'menu_name','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('menu_name'))
                                    <label id="menu_name-error" class="error"
                                           for="menu_name">{{ $errors->first('menu_name') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">مكان القائمه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('menu_position')) error @endif">
                                    {{ Form::select('menu_position',[
                                                                        'header'=>'هيدر الموقع',
                                                                        'header2'=>'القائمة الثانية فى الهيدر',
                                                                        'phone'=>'قائمة الهاتف',
                                                                        'footer'=>'فوتر الموقع',
                                                                    ],$menu->position,array('required'=>true,'id'=>'menu_position','class'=>'form-control show-tick')) }}
                                </div>
                                @if ($errors->has('menu_position'))
                                    <label id="menu_position-error" class="error"
                                           for="menu_position">{{ $errors->first('menu_position') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-2">
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