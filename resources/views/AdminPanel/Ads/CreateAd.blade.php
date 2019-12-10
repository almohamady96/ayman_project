@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Ads') }}">إدارة المساحات الإعلانيه</a></li>
        <li class="active">إضافه إعلان جديد</li>
    </ol>

    {!! Form::open(['files' => true]) !!}
    <!-- Input -->
    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إضافه إعلان جديد
                        <small> {{--@lang('site.Site_Name')--}}املأ البيانات بالأسفل لإضافه إعلان جديد</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">

                        <div class="col-sm-4">

                            <h2 class="card-inside-title">عنوان الإعلان <span
                                        class="small text-muted"> ( إختياري ) </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_name')) error @endif">
                                    {{ Form::text('ad_name','',array('id'=>'ad_name','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('ad_name'))
                                    <label id="ad_name-error" class="error"
                                           for="ad_name">{{ $errors->first('ad_name') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">تاريخ نشر الإعلان</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_publishDate')) error @endif">
                                    {{ Form::text('ad_publishDate','',array('required','id'=>'ad_publishDate','class'=>'datepicker form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('ad_publishDate'))
                                    <label id="ad_publishDate-error" class="error"
                                           for="ad_publishDate">{{ $errors->first('ad_publishDate') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">تاريخ إنتهاء الإعلان</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_expireDate')) error @endif">
                                    {{ Form::text('ad_expireDate','',array('required','id'=>'ad_expireDate','class'=>'datepicker form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('ad_expireDate'))
                                    <label id="ad_expireDate-error" class="error"
                                           for="ad_expireDate">{{ $errors->first('ad_expireDate') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title"> مكان الإعلان</h2>
                            <div class="form-group ">
                                <div class="form-line  @if($errors->has('ad_type')) error @endif">

                                    {{ Form::select('ad_type' ,[
                                                                    'home'=>'الصفحه الرئيسيه',
                                                                    'category'=>'صفحه قسم معين  " أفضل مقاس 350 * 900 "',
                                                                    'popup'=>'إعلان منبثق',
                                                                    'sidebar'=>'الشريط الجانبي " أفضل مقاس 350 * 350 " ',
                                                                    'header' => 'الهيدر " أفضل مقاس 900 * 90 " ',
                                                                    'pages'=>'الصفحات الداخليه مثل من نحن " أفضل مقاس 350 * 900 "',
                                                                    'top_right' => 'أعلي يمين الموقع " أفضل مقاس 130 * 600 " ',
                                                                    'bottom_right' => 'أسفل يمين الموقع " أفضل مقاس 130 * 600 " ',
                                                                    'top_left' => 'أعلي يسار الموقع " أفضل مقاس 130 * 600 " ',
                                                                    'bottom_left' => 'أسفل يسار الموقع " أفضل مقاس 130 * 600 " ',
                                                                    ],'',
                                        array('required','id'=>'ad_type','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                </div>
                                @if ($errors->has('ad_type'))
                                    <label id="ad_type-error" class="error"
                                           for="ad_type">{{ $errors->first('ad_type') }}</label>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-8" id="home_ads">
                            <h2 class="card-inside-title">مكان ظهور الإعلان</h2>
                            <div class="form-group ">
                                <div class="form-line  @if($errors->has('ad_position')) error @endif">

                                    {{ Form::select('ad_position' ,$home_ads,'',
                                    array('required','id'=>'ad_position','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                </div>
                                @if ($errors->has('ad_position'))
                                    <label id="ad_position-error" class="error"
                                           for="ad_position">{{ $errors->first('ad_position') }}</label>
                                @endif
                            </div>

                        </div>


                        <div class="col-sm-8" id="category_ads">
                            <h2 class="card-inside-title">القسم التابع له الإعلان</h2>
                            <div class="form-group ">
                                <div class="form-line  @if($errors->has('ad_category_id')) error @endif">

                                    {{ Form::select('ad_category_id' ,$select_category,'',
                                    array('required','id'=>'ad_category_id','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                </div>
                                @if ($errors->has('ad_category_id'))
                                    <label id="ad_category_id-error" class="error"
                                           for="ad_category_id">{{ $errors->first('ad_category_id') }}</label>
                                @endif
                            </div>

                        </div>


                        <div class="col-sm-8">
                            <h2 class="card-inside-title">رابط الإعلان <span class="small text-muted"> إختياري في حاله إدخال كود الإعلان .. ( مثال : https://www.google.com.eg )</span>
                            </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_link')) error @endif">
                                    {{ Form::text('ad_link','',array('id'=>'','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('ad_link'))
                                    <label id="ad_link-error" class="error"
                                           for="ad_link">{{ $errors->first('ad_link') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title"> صوره الإعلان <span class="small text-muted"> ( إختياري في حاله إدخال كود الإعلان ) </span>
                            </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_image')) error @endif">
                                    <input id="file-photos" class="file" name="ad_image" type="file" {{--multiple--}}>
                                </div>
                                @if ($errors->has('ad_image'))
                                    <label id="ad_image-error" class="error"
                                           for="ad_image">{{ $errors->first('ad_image') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <h2 class="card-inside-title">كود الإعلان <span class="small text-muted"> ( إختياري في حاله إدخال صوره ورابط الإعلان ) </span>
                            </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('ad_code')) error @endif">
                                    {{ Form::textarea('ad_code','',array('rows'=>2,'id'=>'ad_code','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('ad_code'))
                                    <label id="ad_code-error" class="error"
                                           for="ad_code">{{ $errors->first('ad_code') }}</label>
                                @endif
                            </div>
                        </div>


                        <div class="clearfix"></div>

                    </div>
                    <input type="submit" value="حفظ" class="btn bg-teal waves-effect"
                           onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">
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
            if ($('#ad_type').val() == 'home') {
                $('#home_ads').show();
                $('#category_ads').hide();
            } else if ($('#ad_type').val() == 'category') {
                $('#home_ads').hide();
                $('#category_ads').show();
            } else {
                $('#home_ads').hide();
                $('#category_ads').hide();
            }

            $('#ad_type').change(function () {
                if ($('#ad_type').val() == 'home') {
                    $('#home_ads').show();
                    $('#category_ads').hide();
                } else if ($('#ad_type').val() == 'category') {
                    $('#home_ads').hide();
                    $('#category_ads').show();
                } else {
                    $('#home_ads').hide();
                    $('#category_ads').hide();
                }
            });
        });

    </script>
@endsection
