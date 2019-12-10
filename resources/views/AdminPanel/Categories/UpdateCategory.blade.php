@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Categories') }}">إداره الأقسام </a></li>
        <li class="active"> تعديل قسم {{$category->name_ar}}</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        تعديل قسم {{$category->name_ar}}
                        <small>املأ البيانات بالأسفل لتعديل قسم {{$category->name_ar}}</small>

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
                        <li role="presentation" class="">
                            <a href="#statics" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">trending_up</i>الإحصائيات
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="data">
                            <br>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">إسم القسم بالعربية </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_name_ar')) error @endif">
                                            {{ Form::text('category_name_ar',$category->name_ar,array('required'=>true,'id'=>'category_name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('category_name_ar'))
                                            <label id="category_name_ar-error" class="error"
                                                   for="category_name_ar">{{ $errors->first('category_name_ar') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">إسم القسم بالانجليزية </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_name_en')) error @endif">
                                            {{ Form::text('category_name_en',$category->name_en,array('required'=>true,'id'=>'category_name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('category_name_en'))
                                            <label id="category_name_en-error" class="error"
                                                   for="category_name_en">{{ $errors->first('category_name_en') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <h2 class="card-inside-title"> رابط الصفحه<span
                                                class="small text-muted"> ( إختياري ) </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('slug')) error @endif">
                                            {{ Form::text('slug',$category->slug,array('id'=>'slug','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('slug'))
                                            <label id="slug-error" class="error"
                                                   for="slug">{{ $errors->first('slug') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">القسم الرئيسي</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_id')) error @endif">
                                            {{ Form::select('category_id',$select_category,$category->category_id,array('id'=>'category_id','class'=>'form-control show-tick','data-live-search'=>'true')) }}
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <label id="category_id-error" class="error"
                                                   for="category_id">{{ $errors->first('category_id') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">الصفحه الرئيسيه؟</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('isFeature')) error @endif">
                                            {{ Form::select('isFeature',[
                                                                        '0'=>'لا',
                                                                        '1'=>'نعم',
                                                                        ],$category->isFeature,array('id'=>'isFeature','class'=>'form-control show-tick')) }}
                                        </div>
                                        @if ($errors->has('isFeature'))
                                            <label id="isFeature-error" class="error"
                                                   for="isFeature">{{ $errors->first('isFeature') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">الحاله</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('status')) error @endif">
                                            {{ Form::select('status',[
                                                                        'published'=>'منشور',
                                                                        'draft'=>'مؤرشف',
                                                                        ],$category->status,array('id'=>'status','class'=>'form-control show-tick')) }}
                                        </div>
                                        @if ($errors->has('status'))
                                            <label id="status-error" class="error"
                                                   for="status">{{ $errors->first('status') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <h2 class="card-inside-title">الترتيب</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('number')) error @endif">
                                            {{ Form::number('number',$category->number,array('min'=>1,'id'=>'number','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('number'))
                                            <label id="number-error" class="error"
                                                   for="number">{{ $errors->first('number') }}</label>
                                        @endif
                                    </div>
                                </div>


                                {{--<div class="col-sm-12">
                                    <h2 class="card-inside-title"> وصف القسم <span
                                                class="text-muted small"> ( إختياري ) </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_description')) error @endif">
                                            {{ Form::textarea('category_description',$category->description,array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('category_description'))
                                            <label id="category_description-error" class="error"
                                                   for="category_description">{{ $errors->first('category_description') }}</label>
                                        @endif
                                    </div>
                                </div>--}}
                                <div class="clearfix"></div>

                                <div class="clearfix"></div>
                                <?php $x = 1; ?>

                                {{--<div class="col-sm-3">
                                    <h2 class="card-inside-title"> صوره القسم <span class="small text-muted"> ( إختياري ) </span>
                                    </h2>
                                    @if($category->image != null)
                                        <div class="col-sm-12" id="row_{{ $x }}">

                                            <a href="{{URL::to('storage/app/categories/'.$category->id.'/' . $category->image)}}"
                                               target="_blank">
                                                <img src="{{ asset('storage/app/categories/'.$category->id.'/' . $category->image) }}"
                                                     alt="{{$category->name_ar}}"
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Categories/'.$category->id.'/'.$category->image.'/'.$x.'/DeleteImage') }}')"
                                                  class="btn btn-danger btn-sm btn-block"
                                                  style="margin: 10px; width: 50%">حذف الصورة</span>
                                        </div>
                                        <div class="clearfix"></div>

                                    @endif
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_image')) error @endif">
                                            <input id="file-photos" class="file" name="category_image" type="file">
                                        </div>
                                        @if ($errors->has('category_image'))
                                            <label id="category_image-error" class="error"
                                                   for="category_image">{{ $errors->first('category_image') }}</label>
                                        @endif
                                    </div>
                                </div>--}}

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
                                            {{ Form::textarea('seo_title',$category->seo_title,array('rows'=>3,'id'=>'seo_title','class'=>'form-control', 'placeholder'=>'')) }}
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
                                            {{ Form::textarea('seo_description',$category->seo_description,array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
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
                                            {{ Form::textarea('seo_keywords',$category->seo_keywords,array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
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
                                    @if($category->seo_image != null)
                                        <?php  $x++; ?>
                                        <div class="col-sm-12" id="row_{{ $x }}">

                                            <a href="{{URL::to('storage/app/categories/'.$category->id.'/' . $category->seo_image)}}"
                                               target="_blank">
                                                <img src="{{ asset('storage/app/categories/'.$category->id.'/' . $category->seo_image) }}"
                                                     alt="{{$category->name_ar}}"
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/SeoImage/'.$category->id.'/'.$category->seo_image.'/'.$x.'/Category/Delete') }}')"
                                                  class="btn btn-danger btn-sm btn-block"
                                                  style="margin: 10px; width: 40%">حذف الصورة</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    @endif
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

                        <div role="tabpanel" class="tab-pane fade" id="statics">
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>تاريخ إضافه القسم :</label>
                                </div>
                                <div class="col-sm-9">
                                    {{date(' h:m d-m-Y', strtotime($category->created_at))}}

                                </div>
                                <div class="clearfix"></div>

                                <div class="col-sm-3">
                                    <label> الزيارات :</label>
                                </div>
                                <div class="col-sm-9">
                                    {{$category->visits}}
                                </div>
                                <div class="clearfix"></div>
                                <h2 class="text-center">
                                    <a href="{{url('Categories/'.$category->id.'/'.$category['slug'])}}"
                                       target="_blank"
                                       class="btn btn-large bg-orange">الإنتقال للصفحه الخاصه بالقسم في الموقع</a>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">

                </div>

            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop