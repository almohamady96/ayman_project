@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Pages') }}">الصفحات الثابته</a></li>
        <li class="active">إضافه صفحه جديده</li>
    </ol>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه صفحه جديده
                        <small>تستطيع التحكم فى كافة الإعدادات الخاصة بالصفحة من هنا</small>
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-col-teal" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#data" data-toggle="tab" aria-expanded="true">
                                <i class="material-icons">dvr</i> البيانات الأساسيه
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#seo" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">share</i>بيانات الميتا داتا
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="data">
                            <br>

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">إسم الصفحه <span class="text-muted small"> ( مثلاً : من نحن ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_nickName')) error @endif">
                                            {{ Form::text('page_nickName','',array('required','id'=>'page_nickName','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('page_nickName'))
                                            <label id="page_nickName-error" class="error"
                                                   for="page_nickName">{{ $errors->first('page_nickName') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">عنوان الصفحه باللغة العربية </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_name_ar')) error @endif">
                                            {{ Form::text('page_name_ar','',array('id'=>'page_name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('page_name_ar'))
                                            <label id="page_name_ar-error" class="error"
                                                   for="page_name_ar">{{ $errors->first('page_name_ar') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">عنوان الصفحه باللغة الإنجليزية </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_name_en')) error @endif">
                                            {{ Form::text('page_name_en','',array('id'=>'page_name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('page_name_en'))
                                            <label id="page_name_en-error" class="error"
                                                   for="page_name_en">{{ $errors->first('page_name_en') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">عنوان رابط الصفحه المميز<span
                                                class="small text-muted"> ( إختياري ) </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('slug')) error @endif">
                                            {{ Form::text('slug','',array('id'=>'slug','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('slug'))
                                            <label id="slug-error" class="error"
                                                   for="slug">{{ $errors->first('slug') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">تاريخ النشر</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('publishDate')) error @endif">
                                            {{ Form::text('publishDate',date('l d F Y',strtotime('now')),array('id'=>'publishDate','class'=>'form-control datepicker', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('publishDate'))
                                            <label id="publishDate-error" class="error"
                                                   for="publishDate">{{ $errors->first('publishDate') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <h2 class="card-inside-title">محتوي الصفحه باللغة العربية</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_description_ar')) error @endif">
                                            {{ Form::textarea('page_description_ar','',array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('page_description_ar'))
                                            <label id="page_description_ar-error" class="error"
                                                   for="page_description_ar">{{ $errors->first('page_description_ar') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h2 class="card-inside-title">محتوي الصفحه باللغة الإنجليزية</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_description_en')) error @endif">
                                            {{ Form::textarea('page_description_en','',array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('page_description_en'))
                                            <label id="page_description_en-error" class="error"
                                                   for="page_description_en">{{ $errors->first('page_description_en') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">صوره الصفحه <span class="small text-muted"> ( إختياري ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('page_image')) error @endif">
                                            <input id="file-photos" class="file" name="page_image" type="file">
                                        </div>
                                        @if ($errors->has('page_image'))
                                            <label id="page_image-error" class="error"
                                                   for="page_image">{{ $errors->first('page_image') }}</label>
                                        @endif
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="seo">
                            <br>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h2 class="card-inside-title"> عنوان الصفحه <span class="small text-muted"> ( إختياري ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('seo_title')) error @endif">
                                            {{ Form::textarea('seo_title','',array('rows'=>3,'id'=>'seo_title','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('seo_title'))
                                            <label id="seo_title-error" class="error"
                                                   for="seo_title">{{ $errors->first('seo_title') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-7">
                                    <h2 class="card-inside-title"> وصف الصفحه <span class="small text-muted"> ( إختياري ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('seo_description')) error @endif">
                                            {{ Form::textarea('seo_description','',array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('seo_description'))
                                            <label id="seo_description-error" class="error"
                                                   for="seo_description">{{ $errors->first('seo_description') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <h2 class="card-inside-title"> الكلمات الدليليه للصفحه <span
                                                class="small text-muted"> ( إختياري ) </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('seo_keywords')) error @endif">
                                            {{ Form::textarea('seo_keywords','',array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('seo_keywords'))
                                            <label id="seo_keywords-error" class="error"
                                                   for="seo_keywords">{{ $errors->first('seo_keywords') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-sm-5">
                                    <h2 class="card-inside-title"> صوره المشاركه <span class="small text-muted"> ( إختياري ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('seo_image')) error @endif">
                                            <input id="file-photos" class="file" name="seo_image" type="file">
                                        </div>
                                        @if ($errors->has('seo_image'))
                                            <label id="seo_image-error" class="error"
                                                   for="seo_image">{{ $errors->first('seo_image') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">


                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- #END# Input -->

    {!! Form::close() !!}

@stop