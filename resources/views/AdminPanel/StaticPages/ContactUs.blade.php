@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li class="active">إعدادات صفحة إتصل بنا</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إعدادات صفحة إتصل بنا
                        <small>تستطيع التحكم فى كافة الإعدادات الخاصة بالصفحة من هنا</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">عنوان الصفحه </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('contact_title')) error @endif">
                                    {{ Form::text('contact_title',$setting['contact_title']->value,array('id'=>'contact_title','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('contact_title'))
                                    <label id="contact_title-error" class="error"
                                           for="contact_title">{{ $errors->first('contact_title') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h2 class="card-inside-title">محتوي الصفحه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('contact_content')) error @endif">
                                    {{ Form::textarea('contact_content',$setting['contact_content']->value,array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('contact_content'))
                                    <label id="contact_content-error" class="error"
                                           for="contact_content">{{ $errors->first('contact_content') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>


                    </div>
                    <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">


                </div>

            </div>

        </div>
    </div>

    <!-- #END# Input -->

    {!! Form::close() !!}

@stop