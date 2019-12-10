@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li class="active">{{$PageTitle}}</li>
    </ol>

    {!! Form::open(['files' => true,'method'=>'post','url'=>url('/AdminPanel/General/Settings')]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إعدادات سلايدر الصفحة الرئيسية
                        <small></small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="panel panel-col-teal">
                            <div class="panel-heading" role="tab" id="SliderHeading1">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#SliderCollaps" href="#S1" aria-controls="S1">
                                        السلايد الاول فى السلايدر الرئيسى
                                    </a>
                                </h4>
                            </div>
                            <div id="S1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SliderHeading1">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s1img')) error @endif">
                                                    @if(isset($setting['s1img']->value) && $setting['s1img']->value != '')
                                                        <img src="{{ asset('storage/app/Settings/'.$setting['s1img']->value) }}" class="col-sm-12" />
                                                    @endif
                                                    <input name="s1img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s1Title_ar')) error @endif">
                                                    {{ Form::text('s1Title_ar',isset($setting['s1Title_ar']->value) ? $setting['s1Title_ar']->value : '',array('id'=>'s1Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s1Title_en')) error @endif">
                                                    {{ Form::text('s1Title_en',isset($setting['s1Title_en']->value) ? $setting['s1Title_en']->value : '',array('id'=>'s1Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s1Txt_ar')) error @endif">
                                                    {{ Form::textarea('s1Txt_ar',isset($setting['s1Txt_ar']->value) ? $setting['s1Txt_ar']->value : '',array('id'=>'s1Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s1Txt_en')) error @endif">
                                                    {{ Form::textarea('s1Txt_en',isset($setting['s1Txt_en']->value) ? $setting['s1Txt_en']->value : '',array('id'=>'s1Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-red">
                            <div class="panel-heading" role="tab" id="SliderHeading2">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#SliderCollaps" href="#S2" aria-controls="S2">
                                        السلايد الثانى فى السلايدر الرئيسى
                                    </a>
                                </h4>
                            </div>
                            <div id="S2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SliderHeading2">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s2img')) error @endif">
                                                    @if(isset($setting['s2img']->value) && $setting['s2img']->value != '')
                                                        <img src="{{ asset('storage/app/Settings/'.$setting['s2img']->value) }}" class="col-sm-12" />
                                                    @endif
                                                    <input name="s2img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s2Title_ar')) error @endif">
                                                    {{ Form::text('s2Title_ar',isset($setting['s2Title_ar']->value) ? $setting['s2Title_ar']->value : '',array('id'=>'s2Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s2Title_en')) error @endif">
                                                    {{ Form::text('s2Title_en',isset($setting['s2Title_en']->value) ? $setting['s2Title_en']->value : '',array('id'=>'s2Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s2Txt_ar')) error @endif">
                                                    {{ Form::textarea('s2Txt_ar',isset($setting['s2Txt_ar']->value) ? $setting['s2Txt_ar']->value : '',array('id'=>'s2Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s2Txt_en')) error @endif">
                                                    {{ Form::textarea('s2Txt_en',isset($setting['s2Txt_en']->value) ? $setting['s2Txt_en']->value : '',array('id'=>'s2Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-cyan">
                            <div class="panel-heading" role="tab" id="SliderHeading3">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#SliderCollaps" href="#S3" aria-controls="S3">
                                        السلايد الثالث فى السلايدر الرئيسى
                                    </a>
                                </h4>
                            </div>
                            <div id="S3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SliderHeading3">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s3img')) error @endif">
                                                    @if(isset($setting['s3img']->value) && $setting['s3img']->value != '')
                                                        <img src="{{ asset('storage/app/Settings/'.$setting['s3img']->value) }}" class="col-sm-12" />
                                                    @endif
                                                    <input name="s3img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s3Title_ar')) error @endif">
                                                    {{ Form::text('s3Title_ar',isset($setting['s3Title_ar']->value) ? $setting['s3Title_ar']->value : '',array('id'=>'s3Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s3Title_en')) error @endif">
                                                    {{ Form::text('s3Title_en',isset($setting['s3Title_en']->value) ? $setting['s3Title_en']->value : '',array('id'=>'s3Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s3Txt_ar')) error @endif">
                                                    {{ Form::textarea('s3Txt_ar',isset($setting['s3Txt_ar']->value) ? $setting['s3Txt_ar']->value : '',array('id'=>'s3Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s3Txt_en')) error @endif">
                                                    {{ Form::textarea('s3Txt_en',isset($setting['s3Txt_en']->value) ? $setting['s3Txt_en']->value : '',array('id'=>'s3Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-teal">
                            <div class="panel-heading" role="tab" id="SliderHeading4">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#SliderCollaps" href="#S4" aria-controls="S4">
                                        السلايد الرابع فى السلايدر الرئيسى
                                    </a>
                                </h4>
                            </div>
                            <div id="S4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SliderHeading4">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s4img')) error @endif">
                                                    @if(isset($setting['s4img']->value) && $setting['s4img']->value != '')
                                                        <img src="{{ asset('storage/app/Settings/'.$setting['s4img']->value) }}" class="col-sm-12" />
                                                    @endif
                                                    <input name="s4img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s4Title_ar')) error @endif">
                                                    {{ Form::text('s4Title_ar',isset($setting['s4Title_ar']->value) ? $setting['s4Title_ar']->value : '',array('id'=>'s4Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s4Title_en')) error @endif">
                                                    {{ Form::text('s4Title_en',isset($setting['s4Title_en']->value) ? $setting['s4Title_en']->value : '',array('id'=>'s4Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s4Txt_ar')) error @endif">
                                                    {{ Form::textarea('s4Txt_ar',isset($setting['s4Txt_ar']->value) ? $setting['s4Txt_ar']->value : '',array('id'=>'s4Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s4Txt_en')) error @endif">
                                                    {{ Form::textarea('s4Txt_en',isset($setting['s4Txt_en']->value) ? $setting['s4Txt_en']->value : '',array('id'=>'s4Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-red">
                            <div class="panel-heading" role="tab" id="SliderHeading5">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#SliderCollaps" href="#S5" aria-controls="S5">
                                        السلايد الخامس فى السلايدر الرئيسى
                                    </a>
                                </h4>
                            </div>
                            <div id="S5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SliderHeading5">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s5img')) error @endif">
                                                    @if(isset($setting['s5img']->value) && $setting['s5img']->value != '')
                                                        <img src="{{ asset('storage/app/Settings/'.$setting['s5img']->value) }}" class="col-sm-12" />
                                                    @endif
                                                    <input name="s5img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s5Title_ar')) error @endif">
                                                    {{ Form::text('s5Title_ar',isset($setting['s5Title_ar']->value) ? $setting['s5Title_ar']->value : '',array('id'=>'s5Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s5Title_en')) error @endif">
                                                    {{ Form::text('s5Title_en',isset($setting['s5Title_en']->value) ? $setting['s5Title_en']->value : '',array('id'=>'s5Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s5Txt_ar')) error @endif">
                                                    {{ Form::textarea('s5Txt_ar',isset($setting['s5Txt_ar']->value) ? $setting['s5Txt_ar']->value : '',array('id'=>'s5Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('s5Txt_en')) error @endif">
                                                    {{ Form::textarea('s5Txt_en',isset($setting['s5Txt_en']->value) ? $setting['s5Txt_en']->value : '',array('id'=>'s5Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <hr>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">
                                إعدادات صور اسفل السلايدر
                            </h2>
                        </div>
                        <div class="panel panel-col-teal">
                            <div class="panel-heading" role="tab" id="HomeUnderVideoHeading1">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#HomeUnderVideoCollaps" href="#Service1" aria-controls="S1">
                                        الصورة الاولى اسفل السلايدر
                                    </a>
                                </h4>
                            </div>
                            <div id="Service1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="HomeUnderVideoHeading1">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1img')) error @endif">
                                                    @if(isset($setting['Service1img']->value) && $setting['Service1img']->value != '')
                                                        
                                                        <?php $x = 3; ?>
                                                        <div id="row_{{$x}}">
                                                            <img src="{{ asset('storage/app/Settings/'.$setting['Service1img']->value) }}" class="col-sm-12" />
                                                            <div class="clearfix"></div>
                                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/Service1img/'.$setting['Service1img']->value.'/'.$x.'/Delete') }}')"
                                                                class="btn btn-danger btn-sm btn-block"
                                                                style="margin: 10px; width: 50%">حذف الصورة</span>
                                                        </div>
                                                    @endif
                                                    <input name="Service1img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1Title_ar')) error @endif">
                                                    {{ Form::text('Service1Title_ar',isset($setting['Service1Title_ar']->value) ? $setting['Service1Title_ar']->value : '',array('id'=>'Service1Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1Title_en')) error @endif">
                                                    {{ Form::text('Service1Title_en',isset($setting['Service1Title_en']->value) ? $setting['Service1Title_en']->value : '',array('id'=>'Service1Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1Txt_ar')) error @endif">
                                                    {{ Form::textarea('Service1Txt_ar',isset($setting['Service1Txt_ar']->value) ? $setting['Service1Txt_ar']->value : '',array('id'=>'Service1Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1Txt_en')) error @endif">
                                                    {{ Form::textarea('Service1Txt_en',isset($setting['Service1Txt_en']->value) ? $setting['Service1Txt_en']->value : '',array('id'=>'Service1Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">رابط المزيد</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service1URL')) error @endif">
                                                    {{ Form::textarea('Service1URL',isset($setting['Service1URL']->value) ? $setting['Service1URL']->value : '',array('id'=>'Service1URL','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-red">
                            <div class="panel-heading" role="tab" id="HomeUnderVideoHeading2">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#HomeUnderVideoCollaps" href="#Service2" aria-controls="Service2">
                                        الصورة الثانية اسفل السلايدر
                                    </a>
                                </h4>
                            </div>
                            <div id="Service2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="HomeUnderVideoHeading2">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2img')) error @endif">
                                                    @if(isset($setting['Service2img']->value) && $setting['Service2img']->value != '')
                                                        
                                                        <?php $x = 4; ?>
                                                        <div id="row_{{$x}}">
                                                            <img src="{{ asset('storage/app/Settings/'.$setting['Service2img']->value) }}" class="col-sm-12" />
                                                            <div class="clearfix"></div>
                                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/Service2img/'.$setting['Service2img']->value.'/'.$x.'/Delete') }}')"
                                                                class="btn btn-danger btn-sm btn-block"
                                                                style="margin: 10px; width: 50%">حذف الصورة</span>
                                                        </div>
                                                    @endif
                                                    <input name="Service2img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2Title_ar')) error @endif">
                                                    {{ Form::text('Service2Title_ar',isset($setting['Service2Title_ar']->value) ? $setting['Service2Title_ar']->value : '',array('id'=>'Service2Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2Title_en')) error @endif">
                                                    {{ Form::text('Service2Title_en',isset($setting['Service2Title_en']->value) ? $setting['Service2Title_en']->value : '',array('id'=>'Service2Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2Txt_ar')) error @endif">
                                                    {{ Form::textarea('Service2Txt_ar',isset($setting['Service2Txt_ar']->value) ? $setting['Service2Txt_ar']->value : '',array('id'=>'Service2Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2Txt_en')) error @endif">
                                                    {{ Form::textarea('Service2Txt_en',isset($setting['Service2Txt_en']->value) ? $setting['Service2Txt_en']->value : '',array('id'=>'Service2Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">رابط المزيد</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service2URL')) error @endif">
                                                    {{ Form::textarea('Service2URL',isset($setting['Service2URL']->value) ? $setting['Service2URL']->value : '',array('id'=>'Service2URL','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-cyan">
                            <div class="panel-heading" role="tab" id="HomeUnderVideoHeading3">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#HomeUnderVideoCollaps" href="#Service3" aria-controls="Service3">
                                        الصورة الثالثة اسفل السلايدر
                                    </a>
                                </h4>
                            </div>
                            <div id="Service3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="HomeUnderVideoHeading3">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3img')) error @endif">
                                                    @if(isset($setting['Service3img']->value) && $setting['Service3img']->value != '')
                                                        
                                                        <?php $x = 4; ?>
                                                        <div id="row_{{$x}}">
                                                            <img src="{{ asset('storage/app/Settings/'.$setting['Service3img']->value) }}" class="col-sm-12" />
                                                            <div class="clearfix"></div>
                                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/Service3img/'.$setting['Service3img']->value.'/'.$x.'/Delete') }}')"
                                                                class="btn btn-danger btn-sm btn-block"
                                                                style="margin: 10px; width: 50%">حذف الصورة</span>
                                                        </div>
                                                    @endif
                                                    <input name="Service3img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3Title_ar')) error @endif">
                                                    {{ Form::text('Service3Title_ar',isset($setting['Service3Title_ar']->value) ? $setting['Service3Title_ar']->value : '',array('id'=>'Service3Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3Title_en')) error @endif">
                                                    {{ Form::text('Service3Title_en',isset($setting['Service3Title_en']->value) ? $setting['Service3Title_en']->value : '',array('id'=>'Service3Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3Txt_ar')) error @endif">
                                                    {{ Form::textarea('Service3Txt_ar',isset($setting['Service3Txt_ar']->value) ? $setting['Service3Txt_ar']->value : '',array('id'=>'Service3Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3Txt_en')) error @endif">
                                                    {{ Form::textarea('Service3Txt_en',isset($setting['Service3Txt_en']->value) ? $setting['Service3Txt_en']->value : '',array('id'=>'Service3Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">رابط المزيد</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service3URL')) error @endif">
                                                    {{ Form::textarea('Service3URL',isset($setting['Service3URL']->value) ? $setting['Service3URL']->value : '',array('id'=>'Service3URL','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-cyan">
                            <div class="panel-heading" role="tab" id="HomeUnderVideoHeading3">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#HomeUnderVideoCollaps" href="#Service4" aria-controls="Service4">
                                        الصورة الرابعة اسفل السلايدر
                                    </a>
                                </h4>
                            </div>
                            <div id="Service4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="HomeUnderVideoHeading3">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">الصورة</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4img')) error @endif">
                                                    @if(isset($setting['Service4img']->value) && $setting['Service4img']->value != '')
                                                        
                                                        <?php $x = 4; ?>
                                                        <div id="row_{{$x}}">
                                                            <img src="{{ asset('storage/app/Settings/'.$setting['Service4img']->value) }}" class="col-sm-12" />
                                                            <div class="clearfix"></div>
                                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/Service4img/'.$setting['Service4img']->value.'/'.$x.'/Delete') }}')"
                                                                class="btn btn-danger btn-sm btn-block"
                                                                style="margin: 10px; width: 50%">حذف الصورة</span>
                                                        </div>
                                                    @endif
                                                    <input name="Service4img" class="file" type="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4Title_ar')) error @endif">
                                                    {{ Form::text('Service4Title_ar',isset($setting['Service4Title_ar']->value) ? $setting['Service4Title_ar']->value : '',array('id'=>'Service4Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">العنوان باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4Title_en')) error @endif">
                                                    {{ Form::text('Service4Title_en',isset($setting['Service4Title_en']->value) ? $setting['Service4Title_en']->value : '',array('id'=>'Service4Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4Txt_ar')) error @endif">
                                                    {{ Form::textarea('Service4Txt_ar',isset($setting['Service4Txt_ar']->value) ? $setting['Service4Txt_ar']->value : '',array('id'=>'Service4Txt_ar','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4Txt_en')) error @endif">
                                                    {{ Form::textarea('Service4Txt_en',isset($setting['Service4Txt_en']->value) ? $setting['Service4Txt_en']->value : '',array('id'=>'Service4Txt_en','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <h2 class="card-inside-title">رابط المزيد</h2>
                                            <div class="form-group">
                                                <div class="form-line @if($errors->has('Service4URL')) error @endif">
                                                    {{ Form::textarea('Service4URL',isset($setting['Service4URL']->value) ? $setting['Service4URL']->value : '',array('id'=>'Service4URL','class'=>'form-control', 'rows'=>'2')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">
                                إعدادات الفيديو بالرئيسية
                            </h2>
                        </div>

                        <div class="col-sm-6">
                            <h2 class="card-inside-title">وصف الفيديو المميز بالعربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('PromoTxt_ar')) error @endif">
                                    {{ Form::textarea('PromoTxt_ar',isset($setting['PromoTxt_ar']->value) ? $setting['PromoTxt_ar']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="card-inside-title">وصف الفيديو المميز بالإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('PromoTxt_en')) error @endif">
                                    {{ Form::textarea('PromoTxt_en',isset($setting['PromoTxt_en']->value) ? $setting['PromoTxt_en']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="card-inside-title">رفع ملف الفيديو بالرئيسية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('VideoFile')) error @endif">
                                    @if(isset($setting['VideoFile']->value) && $setting['VideoFile']->value != '')
                                        <?php $x = 'video'; ?>
                                        <div id="row_{{$x}}">
                                            <video src="{{ asset('storage/app/Settings/'.$setting['VideoFile']->value) }}" class="col-sm-12"></video>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/VideoFile/'.$setting['VideoFile']->value.'/'.$x.'/Delete') }}')"
                                                class="btn btn-danger btn-sm btn-block"
                                                style="margin: 10px; width: 50%">حذف الفيديو</span>
                                        </div>
                                    @endif
                                    <input name="VideoFile" class="file" type="file" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>


                        <hr>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">
                                إعدادات إحصائيات الأرقام
                            </h2>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الاول بالعربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No1Txt_ar')) error @endif">
                                    {{ Form::text('No1Txt_ar',isset($setting['No1Txt_ar']->value) ? $setting['No1Txt_ar']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الاول بالإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No1Txt_en')) error @endif">
                                    {{ Form::text('No1Txt_en',isset($setting['No1Txt_en']->value) ? $setting['No1Txt_en']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الرقم الاول</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No1Number')) error @endif">
                                    {{ Form::text('No1Number',isset($setting['No1Number']->value) ? $setting['No1Number']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الثاني بالعربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No2Txt_ar')) error @endif">
                                    {{ Form::text('No2Txt_ar',isset($setting['No2Txt_ar']->value) ? $setting['No2Txt_ar']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الثاني بالإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No2Txt_en')) error @endif">
                                    {{ Form::text('No2Txt_en',isset($setting['No2Txt_en']->value) ? $setting['No2Txt_en']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الرقم الثاني</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No2Number')) error @endif">
                                    {{ Form::text('No2Number',isset($setting['No2Number']->value) ? $setting['No2Number']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الثالث بالعربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No3Txt_ar')) error @endif">
                                    {{ Form::text('No3Txt_ar',isset($setting['No3Txt_ar']->value) ? $setting['No3Txt_ar']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الثالث بالإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No3Txt_en')) error @endif">
                                    {{ Form::text('No3Txt_en',isset($setting['No3Txt_en']->value) ? $setting['No3Txt_en']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الرقم الثالث</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No3Number')) error @endif">
                                    {{ Form::text('No3Number',isset($setting['No3Number']->value) ? $setting['No3Number']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الرابع بالعربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No4Txt_ar')) error @endif">
                                    {{ Form::text('No4Txt_ar',isset($setting['No4Txt_ar']->value) ? $setting['No4Txt_ar']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان الرقم الرابع بالإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No4Txt_en')) error @endif">
                                    {{ Form::text('No4Txt_en',isset($setting['No4Txt_en']->value) ? $setting['No4Txt_en']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الرقم الرابع</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('No4Number')) error @endif">
                                    {{ Form::text('No4Number',isset($setting['No4Number']->value) ? $setting['No4Number']->value : '',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                            </div>
                        </div>



                    </div>
                    {{ Form::submit('حفظ',array('value'=>'Submit','class'=>'btn bg-teal waves-effect')) }}

                </div>

            </div>
        </div>
    </div>



    <!-- #END# Input -->

    {!! Form::close() !!}

@stop


@section('script')
    <script>
        $(document).ready(function () {
            if ($('#home_slider').val() == '1') {
                $('#category').show();
            } else {
                $('#category').hide();
            }

            $('#home_slider').change(function () {
                if ($('#home_slider').val() == '1') {
                    $('#category').show();
                } else {
                    $('#category').hide();
                }
            });
        });
    </script>
@endsection
