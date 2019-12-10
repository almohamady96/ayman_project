@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Questionnaires') }}">إدارة الإستفتاءات</a></li>
        <li class="active">إضافه إستفتاء جديد</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه إستفتاء جديد
                        <small> {{--@lang('site.Site_Name')--}}املأ البيانات بالأسفل لإضافه إستفتاء جديد</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-6">
                            <h2 class="card-inside-title">سؤال الإستفتاء <span class="small text-muted"> </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_q')) error @endif">
                                    {{ Form::text('questionnaire_q','',array('required','id'=>'questionnaire_q','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_q'))
                                    <label id="questionnaire_q-error" class="error"
                                           for="questionnaire_q">{{ $errors->first('questionnaire_q') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h2 class="card-inside-title">تاريخ نشر الإستفتاء</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_publishDate')) error @endif">
                                    {{ Form::text('questionnaire_publishDate','',array('required','id'=>'questionnaire_publishDate','class'=>'datepicker form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_publishDate'))
                                    <label id="questionnaire_publishDate-error" class="error"
                                           for="questionnaire_publishDate">{{ $errors->first('questionnaire_publishDate') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">تاريخ إنتهاء الإستفتاء</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_expireDate')) error @endif">
                                    {{ Form::text('questionnaire_expireDate','',array('required','id'=>'questionnaire_expireDate','class'=>'datepicker form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_expireDate'))
                                    <label id="questionnaire_expireDate-error" class="error"
                                           for="questionnaire_expireDate">{{ $errors->first('questionnaire_expireDate') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإختيار الأول<span class="small text-muted">  </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_a1')) error @endif">
                                    {{ Form::text('questionnaire_a1','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_a1'))
                                    <label id="questionnaire_a1-error" class="error"
                                           for="questionnaire_a1">{{ $errors->first('questionnaire_a1') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإختيار الثاني<span class="small text-muted">  </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_a2')) error @endif">
                                    {{ Form::text('questionnaire_a2','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_a2'))
                                    <label id="questionnaire_a2-error" class="error"
                                           for="questionnaire_a2">{{ $errors->first('questionnaire_a2') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإختيار الثالث<span class="small text-muted"> ( إختياري ) </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_a3')) error @endif">
                                    {{ Form::text('questionnaire_a3','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_a3'))
                                    <label id="questionnaire_a3-error" class="error"
                                           for="questionnaire_a3">{{ $errors->first('questionnaire_a3') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإختيار الرابع<span class="small text-muted"> ( إختياري ) </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_a4')) error @endif">
                                    {{ Form::text('questionnaire_a4','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_a4'))
                                    <label id="questionnaire_a4-error" class="error"
                                           for="questionnaire_a4">{{ $errors->first('questionnaire_a4') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الإختيار الخامس<span class="small text-muted"> ( إختياري ) </span> </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('questionnaire_a5')) error @endif">
                                    {{ Form::text('questionnaire_a5','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('questionnaire_a5'))
                                    <label id="questionnaire_a5-error" class="error"
                                           for="questionnaire_a5">{{ $errors->first('questionnaire_a5') }}</label>
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