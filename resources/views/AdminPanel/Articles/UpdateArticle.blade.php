@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        @if(isset($category))
            <li><a href="{{ URL::to('/AdminPanel/Categories') }}">إداره الأقسام</a></li>
            <li>
                <a href="{{ URL::to('/AdminPanel/Categories/'.$category->id.'/Articles') }}">مقالات {{\Illuminate\Support\Str::limit($category->name_ar,40)}}</a>
            </li>
        @else
            <li><a href="{{ URL::to('/AdminPanel/Articles') }}">كل المقالات</a></li>
        @endif
        <li class="active">{{\Illuminate\Support\Str::limit($article->name_ar,40)}}</li>
    </ol>

    {!! Form::open(['files' => true,'method'=>'post','url'=>url('/AdminPanel/Articles/'.$article->id.'/Edit')]) !!}
    <!-- Input -->
    {!! csrf_field() !!}
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{\Illuminate\Support\Str::limit($article->name_ar,40)}}
                        <small> {{--@lang('site.Site_Name')--}}املأ البيانات بالأسفل لتعديل المنتج</small>
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
                                <div class="col-sm-5">
                                    <h2 class="card-inside-title">عنوان المقال</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_name_ar')) error @endif">
                                            {{ Form::text('article_name_ar',$article->name_ar,array('required'=>true,'id'=>'article_name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('article_name_ar'))
                                            <label id="article_name_ar-error" class="error"
                                                   for="article_name_ar">{{ $errors->first('article_name_ar') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h2 class="card-inside-title">عنوان رابط الصفحه المميز<span
                                                class="small text-muted"> ( إختياري ) </span></h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('slug')) error @endif">
                                            {{ Form::text('slug',$article->slug,array('id'=>'slug','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('slug'))
                                            <label id="slug-error" class="error"
                                                   for="slug">{{ $errors->first('slug') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title"> القسم التابع له</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('category_id')) error @endif">

                                            {{ Form::select('category_id',$select_category, $article->category_id ,array('id'=>'category_id','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <label id="category_id-error" class="error"
                                                   for="category_id">{{ $errors->first('category_id') }}</label>
                                        @endif
                                    </div>
                                </div>
                                {{--<div class="col-sm-1">
                                    <h2 class="card-inside-title">الترتيب</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('number')) error @endif">
                                            {{ Form::number('number',$article->number,array('min'=>1,'id'=>'number','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('number'))
                                            <label id="number-error" class="error"
                                                   for="number">{{ $errors->first('number') }}</label>
                                        @endif
                                    </div>
                                </div>--}}
                                <div class="clearfix"></div>
                                {{--<div class="col-sm-2">
                                    <h2 class="card-inside-title">الصفحه الرئيسه؟</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_isFeature')) error @endif">

                                            {{ Form::select('article_isFeature',[
                                                                            '0'=>'لا',
                                                                            '1'=>'نعم',
                                                                            ],$article->isFeature,array('id'=>'article_isFeature','class'=>'form-control selectpicker show-tick')) }}
                                        </div>
                                        @if ($errors->has('article_isFeature'))
                                            <label id="article_isFeature-error" class="error"
                                                   for="article_isFeature">{{ $errors->first('article_isFeature') }}</label>
                                        @endif
                                    </div>

                                </div>--}}


                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">تاريخ النشر</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('publishDate')) error @endif">
                                            {{ Form::text('publishDate',$article->publishDate,array('id'=>'publishDate','class'=>'form-control datepicker', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('publishDate'))
                                            <label id="publishDate-error" class="error"
                                                   for="publishDate">{{ $errors->first('publishDate') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">كُتب بواسطه</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_author')) error @endif">
                                            {{ Form::text('article_author',$article->author != '' ? $article->author : 'الإداره',array('id'=>'article_author','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('article_author'))
                                            <label id="article_author-error" class="error"
                                                   for="article_author">{{ $errors->first('article_author') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">نوع الملف الإفتتاحي </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_file_type')) error @endif">

                                            {{ Form::select('article_file_type',[
                                                                        'image'=>'صوره عاديه',
                                                                        'image360'=>'صوره 360 درجه',
                                                                        'slider'=>'سلايدر صور',
                                                                        'video_file'=>'ملف فيديو',
                                                                        'youtube'=>'رابط يوتيوب',
                                                                        //'vimeo'=>'رابط فيمو',
                                                                        ],$article->file_type,array('id'=>'article_file_type','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                        </div>
                                        @if ($errors->has('article_file_type'))
                                            <label id="article_file_type-error" class="error"
                                                   for="article_file_type">{{ $errors->first('article_file_type') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-5" id="online_link">
                                    <h2 class="card-inside-title" id="link_text"> رابط الفيديو <span class="small text-muted"></span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_file_link')) error @endif">
                                            {{ Form::text('article_file_link',$article->link,array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('article_file_link'))
                                            <label id="article_file_link-error" class="error"
                                                   for="article_file_link">{{ $errors->first('article_file_link') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-12">
                                    <h2 class="card-inside-title">وصف مُختصر للمقال <span class="text-muted small"> ( إختياري ) </span>
                                    </h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_summary')) error @endif">
                                            {{ Form::textarea('article_summary',$article->summary,array('rows'=>'3','id'=>'article_summary','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('article_summary'))
                                            <label id="article_summary-error" class="error"
                                                   for="article_summary">{{ $errors->first('article_summary') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <h2 class="card-inside-title">محتوي المقال <span
                                                class="small text-muted"></span></h2>

                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_description_ar')) error @endif">
                                            {{ Form::textarea('article_description_ar',$article->description_ar,array('id'=>'tinymce','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('article_description_ar'))
                                            <label id="article_description_ar-error" class="error"
                                                   for="article_description_ar">{{ $errors->first('article_description_ar') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-sm-2">
                                    <h2 class="card-inside-title">الحاله</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('status')) error @endif">
                                            {{ Form::select('status',[
                                                                        'published'=>'منشور',
                                                                        'draft'=>'مؤرشف',
                                                                        ],$article->status,array('id'=>'status','class'=>'form-control show-tick')) }}
                                        </div>
                                        @if ($errors->has('status'))
                                            <label id="status-error" class="error"
                                                   for="status">{{ $errors->first('status') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <h2 class="card-inside-title">صوره المقال المميزه <span
                                                class="small text-muted"></span></h2>
                                    <a href="{{URL::to('storage/app/articles/'.$article->id.'/' . $article->image)}}"
                                       target="_blank">
                                        <img src="{{ asset('storage/app/articles/'.$article->id.'/' . $article->image) }}"
                                             alt="{{$article->name}}"
                                             style="max-height:200px;width:auto;max-width:100%; margin:10px auto;">
                                    </a>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_image')) error @endif">
                                            <input id="file-photos" class="file" name="article_image"
                                                   type="file">
                                        </div>
                                        @if ($errors->has('article_image'))
                                            <label id="article_image-error" class="error"
                                                   for="article_image">{{ $errors->first('article_image') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-7" id="offline_file">
                                    <h2 class="card-inside-title" id="file_text">الملف المرفق<span
                                                class="small text-muted"></span>
                                    </h2>

                                    @if($article->file_type =='image')
                                        <a href="{{URL::to('storage/app/articles/'.$article->id.'/' . $article->file)}}"
                                           target="_blank">
                                            <img src="{{ asset('storage/app/articles/'.$article->id.'/' . $article->file) }}"
                                                 alt="{{$article->name}}"
                                                 style="max-height:200px;width:auto;max-width:100%; margin:10px auto;">
                                        </a>

                                    @endif
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_file')) error @endif">
                                            <input id="file-photos" class="file" name="article_file" type="file">
                                        </div>
                                        @if ($errors->has('article_file'))
                                            <label id="article_file-error" class="error"
                                                   for="article_file">{{ $errors->first('article_file') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-7" id="slider_files">
                                    <h2 class="card-inside-title">صور الإسلايدر الداخلي للمقال<span
                                                class="small text-muted"> </span>
                                    </h2>
                                    <?php
                                    $x = 1
                                    ?>
                                    <?php
                                    if ($article->photos != '') {
                                    $y = 1;
                                    ?>
                                    <div class="row" id="row" style="">
                                        <?php
                                        $photos = unserialize(base64_decode($article->photos));
                                        foreach ($photos as $photo) {
                                        $image_path = base_path() . '/storage/app/articles/' . $article->id . '/photos/' . $photo;
                                        if(File::exists($image_path)){
                                        ?>
                                        <div class="col-sm-4 text-center" id="row_{{ $x }}">
                                            <a href="{{ asset('/storage/app/articles/' . $article->id . '/photos/' . $photo) }}"
                                               target="_blank">
                                                <img src="{{ asset('/storage/app/articles/' . $article->id . '/photos/' . $photo) }}"
                                                     style="width: 300px;height:auto;max-width:100%; margin:10px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Articles/'.$article->id.'/'.$photo.'/'.$x.'/DeletePhoto') }}')"
                                                  class="btn btn-danger btn-sm btn-block"
                                                  style="margin: 10px; width: 70%">حذف الصورة</span>
                                        </div>

                                        @if( $y % 3 === 0 )
                                            <div class="clearfix"></div>
                                        @endif

                                        <?php
                                        $y++;
                                        }
                                        $x++;
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('article_photos.*')) error @endif">
                                            <input id="file-photos" class="file" name="article_photos[]" multiple
                                                   type="file">
                                        </div>
                                        @if ($errors->has('article_photos.*'))
                                            <label id="article_photos-error" class="error"
                                                   for="article_photos">{{ $errors->first('article_photos.*') }}</label>
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
                                            {{ Form::textarea('seo_title',$article->seo_title,array('rows'=>3,'id'=>'seo_title','class'=>'form-control', 'placeholder'=>'')) }}
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
                                            {{ Form::textarea('seo_description',$article->seo_description,array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
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
                                            {{ Form::textarea('seo_keywords',$article->seo_keywords,array('rows'=>3,'id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
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
                                    @if($article->seo_image != null)
                                        <?php  $x++; ?>
                                        <div class="col-sm-12" id="row_{{ $x }}">

                                            <a href="{{URL::to('storage/app/articles/'.$article->id.'/' . $article->seo_image)}}"
                                               target="_blank">
                                                <img src="{{ asset('storage/app/articles/'.$article->id.'/' . $article->seo_image) }}"
                                                     alt="{{$article->name}}"
                                                     style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                            </a>
                                            <div class="clearfix"></div>
                                            <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/SeoImage/'.$article->id.'/'.$article->seo_image.'/'.$x.'/Article/Delete') }}')"
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
                                    {{date(' h:m d-m-Y', strtotime($article->created_at))}}

                                </div>
                                <div class="clearfix"></div>

                                <div class="col-sm-3">
                                    <label> الزيارات :</label>
                                </div>
                                <div class="col-sm-9">
                                    {{$article->visits}}
                                </div>
                                <div class="clearfix"></div>
                                <h2 class="text-center">
                                    <a href="{{url('/Categories/'.$article->category_id.'/Articles/'.$article->id.'/'.$article['slug'])}}"
                                       target="_blank"
                                       class="btn btn-large bg-orange">الإنتقال للصفحه الخاصه بالمقال في الموقع</a>
                                </h2>
                            </div>
                        </div>

                        <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">
                    </div>
                </div>
            </div>

            @if( $article->file_type =='vimeo' || $article->file_type =='youtube' || $article->file_type =='video_file' )
                <div class="card">
                    <div class="body">
                        @if($article->file_type == 'youtube')
                            <?php
                            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $article->link, $match);
                            $youtube_id = $match[1];
                            ?>
                            <iframe src="https://www.youtube.com/embed/{{$youtube_id}}" frameborder="0"
                                    allow="autoplay; encrypted-media" allowfullscreen
                                    width="100%" height="400px"></iframe>
                        @endif
                        @if($article->file_type =='vimeo')
                            <?php
                            $vimeo_id = (int)substr(parse_url($article->link, PHP_URL_PATH), 1);
                            ?>
                            <iframe src="https://player.vimeo.com/video/{{$vimeo_id}}"
                                    frameborder="0" webkitallowfullscreen mozallowfullscreen
                                    allowfullscreen width="100%" height="400px">

                            </iframe>
                        @endif
                        @if($article->file_type =='video_file')
                            <video src="{{URL::to('storage/app/articles/'.$article->id.'/'.$article->file)}}"
                                   controls style="width: 100%;height: 400px;">
                            </video>
                        @endif

                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- #END# Input -->

    {!! Form::close() !!}

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if ($('#article_file_type').val() == 'youtube') {
                $('#online_link').show();
                $('#offline_file').hide();
                $('#slider_files').hide();
                $('#link_text').html("رابط اليوتيوب");

            } else if ($('#article_file_type').val() == 'vimeo') {
                $('#online_link').show();
                $('#offline_file').hide();
                $('#slider_files').hide();
                $('#link_text').html("رابط فيمو");

            } else {
                if ($('#article_file_type').val() == 'slider') {
                    $('#slider_files').show();
                    $('#online_link').hide();
                    $('#offline_file').hide();
                } else {

                    $('#offline_file').show();
                    $('#online_link').hide();
                    $('#slider_files').hide();

                    if ($('#article_file_type').val() == 'image') {
                        $('#file_text').html("الصوره الإفتتاحيه للمقال");
                    } else if ($('#article_file_type').val() == 'image360') {
                        $('#link_text').html("رابط الصوره الإفتتاحيه للمقال بشكل 360 درجه");
                        $('#online_link').show();
                        $('#offline_file').hide();

                    } else {
                        $('#file_text').html("ملف الفيديو");
                    }
                }
            }

            $('#article_file_type').change(function () {
                if ($('#article_file_type').val() == 'youtube') {
                    $('#online_link').show();
                    $('#offline_file').hide();
                    $('#slider_files').hide();
                    $('#link_text').html("رابط اليوتيوب");
                } else if ($('#article_file_type').val() == 'vimeo') {
                    $('#online_link').show();
                    $('#offline_file').hide();
                    $('#slider_files').hide();
                    $('#link_text').html("رابط فيمو");

                } else {
                    if ($('#article_file_type').val() == 'slider') {
                        $('#slider_files').show();
                        $('#online_link').hide();
                        $('#offline_file').hide();
                    } else {
                        $('#offline_file').show();
                        $('#online_link').hide();
                        $('#slider_files').hide();

                        if ($('#article_file_type').val() == 'image') {
                            $('#file_text').html("الصوره الإفتتاحيه للمقال");
                        } else if ($('#article_file_type').val() == 'image360') {
                            $('#link_text').html("رابط الصوره الإفتتاحيه للمقال بشكل 360 درجه");
                            $('#online_link').show();
                            $('#offline_file').hide();

                        } else {
                            $('#file_text').html("ملف الفيديو");
                        }
                    }
                }
            });
        });
    </script>
@endsection
