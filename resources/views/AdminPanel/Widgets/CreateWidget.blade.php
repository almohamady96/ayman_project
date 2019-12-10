@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/Widgets') }}">كل الودجات</a></li>
        <li class="active">إضافه ودجت جديد</li>
    </ol>

    {!! Form::open(['files' => true,'method'=>'post','url'=>url('/AdminPanel/Widgets/CreateWidget')]) !!}
    <!-- Input -->
    {!! csrf_field() !!}
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ودجت جديد
                        <small> {{--@lang('site.Site_Name')--}}املأ البيانات بالأسفل لإضافه ودجت جديد</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-4" id="widget_name">
                            <h2 class="card-inside-title">عنوان الودجت</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_name')) error @endif">
                                    {{ Form::text('widget_name','',array('id'=>'widget_name','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('widget_name'))
                                    <label id="widget_name-error" class="error"
                                           for="widget_name">{{ $errors->first('widget_name') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <h2 class="card-inside-title">الترتيب</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('number')) error @endif">
                                    {{ Form::number('number','',array('min'=>1,'id'=>'number','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('number'))
                                    <label id="number-error" class="error"
                                           for="number">{{ $errors->first('number') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <h2 class="card-inside-title">نوع الودجت</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_type')) error @endif">

                                    {{ Form::select('widget_type',$select_widget_type,'',array('id'=>'widget_type','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                </div>
                                @if ($errors->has('widget_type'))
                                    <label id="widget_type-error" class="error"
                                           for="widget_type">{{ $errors->first('widget_type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3 articles">
                            <h2 class="card-inside-title"> القسم </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_category_id')) error @endif">

                                    {{ Form::select('widget_category_id',$select_category, '',array('id'=>'widget_category_id','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                </div>
                                @if ($errors->has('widget_category_id'))
                                    <label id="widget_category_id-error" class="error"
                                           for="widget_category_id">{{ $errors->first('widget_category_id') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-2 articles">
                            <h2 class="card-inside-title"> نوع المقالات </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_query_type')) error @endif">

                                    {{ Form::select('widget_query_type',[
                                                                        'most_viewed'=>'الأكثر مشاهده',
                                                                        'recently_added'=>'المضاف حديثاَ',
                                                                        ], '',array('id'=>'widget_query_type','class'=>'form-control selectpicker show-tick')) }}
                                </div>
                                @if ($errors->has('widget_query_type'))
                                    <label id="widget_query_type-error" class="error"
                                           for="widget_query_type">{{ $errors->first('widget_query_type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix" id="articles_clr"></div>
                        <div class="col-sm-2 articles">
                            <h2 class="card-inside-title">عدد المقالات</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_count')) error @endif">
                                    {{ Form::number('widget_count','',array('min'=>1,'id'=>'widget_count','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('widget_count'))
                                    <label id="widget_count-error" class="error"
                                           for="widget_count">{{ $errors->first('widget_count') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-9" id="ad">
                            <h2 class="card-inside-title"> الإعلان </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_ad_id')) error @endif">

                                    {{ Form::select('widget_ad_id',$select_ad, '',array('id'=>'widget_ad_id','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                </div>
                                @if ($errors->has('widget_ad_id'))
                                    <label id="widget_ad_id-error" class="error"
                                           for="widget_ad_id">{{ $errors->first('widget_ad_id') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-5" id="questionnaire">
                            <h2 class="card-inside-title"> الإستفتاء </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_questionnaire_id')) error @endif">

                                    {{ Form::select('widget_questionnaire_id',$select_questionnaire, '',array('id'=>'widget_questionnaire_id','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                </div>
                                @if ($errors->has('widget_questionnaire_id'))
                                    <label id="widget_questionnaire_id-error" class="error"
                                           for="widget_questionnaire_id">{{ $errors->first('widget_questionnaire_id') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-5" id="feature_article">
                            <h2 class="card-inside-title"> المقال </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('widget_article_id')) error @endif">

                                    {{ Form::select('widget_article_id',$select_article, '',array('id'=>'widget_article_id','class'=>'form-control selectpicker show-tick','data-live-search'=>'true')) }}
                                </div>
                                @if ($errors->has('widget_article_id'))
                                    <label id="widget_article_id-error" class="error"
                                           for="widget_article_id">{{ $errors->first('widget_article_id') }}</label>
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

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if ($('#widget_type').val() == 'questionnaire') {
                $('#questionnaire').show();
                $('#widget_name').show();
                $('#articles_clr').hide();
                $('.articles').hide();
                $('#ad').hide();
                $('#feature_article').hide();

            } else if ($('#widget_type').val() == 'articles') {
                $('.articles').show();
                $('#widget_name').show();
                $('#articles_clr').show();
                $('#questionnaire').hide();
                $('#ad').hide();
                $('#feature_article').hide();

            } else if ($('#widget_type').val() == 'slider') {
                $('.articles').show();
                $('#widget_name').show();
                $('#articles_clr').show();
                $('#questionnaire').hide();
                $('#ad').hide();
                $('#feature_article').hide();

            } else if ($('#widget_type').val() == 'feature_article') {
                $('#feature_article').show();
                $('#widget_name').show();
                $('#articles_clr').hide();
                $('.articles').hide();
                $('#questionnaire').hide();
                $('#ad').hide();

            } else {
                $('#ad').show();
                $('#widget_name').hide();
                $('#articles_clr').hide();
                $('#feature_article').hide();
                $('.articles').hide();
                $('#questionnaire').hide();
            }

            $('#widget_type').change(function () {
                if ($('#widget_type').val() == 'questionnaire') {
                    $('#questionnaire').show();
                    $('#widget_name').show();
                    $('#articles_clr').hide();
                    $('.articles').hide();
                    $('#ad').hide();
                    $('#feature_article').hide();

                } else if ($('#widget_type').val() == 'articles') {
                    $('.articles').show();
                    $('#widget_name').show();
                    $('#articles_clr').show();
                    $('#questionnaire').hide();
                    $('#ad').hide();
                    $('#feature_article').hide();

                } else if ($('#widget_type').val() == 'slider') {
                    $('.articles').show();
                    $('#widget_name').show();
                    $('#articles_clr').show();
                    $('#questionnaire').hide();
                    $('#ad').hide();
                    $('#feature_article').hide();

                } else if ($('#widget_type').val() == 'feature_article') {
                    $('#feature_article').show();
                    $('#widget_name').show();
                    $('#articles_clr').hide();
                    $('.articles').hide();
                    $('#questionnaire').hide();
                    $('#ad').hide();

                } else {
                    $('#ad').show();
                    $('#widget_name').hide();
                    $('#articles_clr').hide();
                    $('#feature_article').hide();
                    $('.articles').hide();
                    $('#questionnaire').hide();
                }
            });
        });
    </script>
@endsection
