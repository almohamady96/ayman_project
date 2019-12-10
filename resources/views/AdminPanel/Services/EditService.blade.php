@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">رئيسية لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Services') }}">إدارة الخدمات</a></li>
        <li class="active">تعديل بيانات الدورة التدريبية</li>
    </ol>

    {!! Form::open(['files'=>true]) !!}
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            بيانات الدورة التدريبية: {{$Service->Title_ar}}
                            <small>{{ trans('Site.FillFormInputs') }}</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <h2 class="card-inside-title">عنوان الدورة التدريبية باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Title_ar')) error @endif">
                                        {{ Form::text('Title_ar',$Service->Title_ar,array('id'=>'Title_ar','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Title_ar')) 
                                        <label id="Title_ar-error" class="error" for="Title_ar">{{ $errors->first('Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h2 class="card-inside-title">عنوان الدورة التدريبية باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Title_en')) error @endif">
                                        {{ Form::text('Title_en',$Service->Title_en,array('id'=>'Title_en','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Title_en')) 
                                        <label id="Title_en-error" class="error" for="Title_en">{{ $errors->first('Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">القسم</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('SectionID')) error @endif">
                                        {{ Form::select('SectionID',$Sections,$Service->SectionID,array('id'=>'SectionID','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('SectionID')) 
                                        <label id="SectionID-error" class="error" for="SectionID">{{ $errors->first('SectionID') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">الترتيب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Ordered')) error @endif">
                                        {{ Form::number('Ordered',$Service->Ordered,array('id'=>'Ordered','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Ordered')) 
                                        <label id="Ordered-error" class="error" for="Ordered">{{ $errors->first('Ordered') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">مميز بالرئيسية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('featured')) error @endif">
                                        {{ Form::select('featured',['0'=>'غير مميز','1'=>'مميز'],'',array('id'=>'featured','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('featured')) 
                                        <label id="featured-error" class="error" for="featured">{{ $errors->first('featured') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">عدد الساعات</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Hours')) error @endif">
                                        {{ Form::number('Hours',$Service->Hours,array('id'=>'Hours','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Hours')) 
                                        <label id="Hours-error" class="error" for="Hours">{{ $errors->first('Hours') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">عدد الأيام</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('Days')) error @endif">
                                        {{ Form::number('Days',$Service->Days,array('id'=>'Days','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('Days')) 
                                        <label id="Days-error" class="error" for="Days">{{ $errors->first('Days') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الوصف باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('des_ar')) error @endif">
                                        {{ Form::textarea('des_ar',$Service->des_ar,array('rows'=>'3','id'=>'des_ar','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('des_ar')) 
                                        <label id="des_ar-error" class="error" for="des_ar">{{ $errors->first('des_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الوصف باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('des_en')) error @endif">
                                        {{ Form::textarea('des_en',$Service->des_en,array('rows'=>'3','id'=>'des_en','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('des_en'))
                                        <label id="des_en-error" class="error" for="des_en">{{ $errors->first('des_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">التفاصيل باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('details_ar')) error @endif">
                                        {{ Form::textarea('details_ar',$Service->details_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('details_ar')) 
                                        <label id="details_ar-error" class="error" for="details_ar">{{ $errors->first('details_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">التفاصيل باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('details_en')) error @endif">
                                        {{ Form::textarea('details_en',$Service->details_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('details_en'))
                                        <label id="details_en-error" class="error" for="details_en">{{ $errors->first('details_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الهدف العام باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab1_ar')) error @endif">
                                        {{ Form::textarea('tab1_ar',$Service->tab1_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab1_ar')) 
                                        <label id="tab1_ar-error" class="error" for="tab1_ar">{{ $errors->first('tab1_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الهدف العام باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab1_en')) error @endif">
                                        {{ Form::textarea('tab1_en',$Service->tab1_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab1_en'))
                                        <label id="tab1_en-error" class="error" for="tab1_en">{{ $errors->first('tab1_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الأهداف التفصيلية باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab2_ar')) error @endif">
                                        {{ Form::textarea('tab2_ar',$Service->tab2_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab2_ar')) 
                                        <label id="tab2_ar-error" class="error" for="tab2_ar">{{ $errors->first('tab2_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الأهداف التفصيلية باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab2_en')) error @endif">
                                        {{ Form::textarea('tab2_en',$Service->tab2_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab2_en'))
                                        <label id="tab2_en-error" class="error" for="tab2_en">{{ $errors->first('tab2_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">موضوعات التدريب باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab3_ar')) error @endif">
                                        {{ Form::textarea('tab3_ar',$Service->tab3_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab3_ar')) 
                                        <label id="tab3_ar-error" class="error" for="tab3_ar">{{ $errors->first('tab3_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">موضوعات التدريب باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab3_en')) error @endif">
                                        {{ Form::textarea('tab3_en',$Service->tab3_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab3_en'))
                                        <label id="tab3_en-error" class="error" for="tab3_en">{{ $errors->first('tab3_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">أساليب ووسائل التدريب باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab4_ar')) error @endif">
                                        {{ Form::textarea('tab4_ar',$Service->tab4_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab4_ar')) 
                                        <label id="tab4_ar-error" class="error" for="tab4_ar">{{ $errors->first('tab4_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">أساليب ووسائل التدريب باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab4_en')) error @endif">
                                        {{ Form::textarea('tab4_en',$Service->tab4_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab4_en'))
                                        <label id="tab4_en-error" class="error" for="tab4_en">{{ $errors->first('tab4_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">المشاركون باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab5_ar')) error @endif">
                                        {{ Form::textarea('tab5_ar',$Service->tab5_ar,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab5_ar')) 
                                        <label id="tab5_ar-error" class="error" for="tab5_ar">{{ $errors->first('tab5_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">المشاركون باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('tab5_en')) error @endif">
                                        {{ Form::textarea('tab5_en',$Service->tab5_en,array('id'=>'tinymce','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('tab5_en'))
                                        <label id="tab5_en-error" class="error" for="tab5_en">{{ $errors->first('tab5_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">صورة الدورة التدريبية</h2>
                                <div class="form-group">
                                    <div class="form-group center">
                                        <div id="Logo-holder" class="col-sm-12">
                                            @if($Service->photo != '')
                                                <img src="{{ asset('storage/app/public/Services/'.$Service->id.'/'.$Service->photo) }}">
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="btn">
                                            <input id="LogoUpload" name="photo" type="file">
                                        </div>
                                    </div>
                                    @if ($errors->has('photo')) 
                                        <label id="photo-error" class="error" for="photo">{{ $errors->first('photo') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h2 class="card-inside-title">صور إضافية</h2>
                                <div class="AllPhotos">
                                    @if($Service->photos != '')
                                        <?php $Userialiezed = unserialize($Service->photos); ?>
                                        @foreach ($Userialiezed as $value)
                                            <?php
                                                $PhotoPath = base_path().'/storage/app/public/Services/'.$Service->id.'/photos/'.$value;
                                                if(File::exists($PhotoPath)){
                                            ?>
                                                <div class="col-sm-3 text-center" id="row_{{ $value }}">
                                                    <img src="{{ asset('storage/app/public/Services/'.$Service->id.'/photos/'.$value) }}" style="max-height:100px;max-width:100%; margin:5px auto;">
                                                    <div class="clearfix"></div>
                                                    <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Services/'.$Service->id.'/DeletePhoto/'.$value) }}')" class="btn btn-danger btn-sm btn-block">حذف الصورة</span>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input name="photos[]" id="file-photos" class="file" type="file" multiple>
                                </div>
                            </div>
                        </div>
                        {{ Form::submit(trans('Site.Save'),array('value'=>trans('Site.Save'),'class'=>'btn bg-teal waves-effect')) }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->

    {!! Form::close() !!}

@stop