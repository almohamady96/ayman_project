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
                        إعدادات المربعات الثلاثة
                        <small>اتركه فارغا لتختفى المربعات الثلاثة</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">مختصر عربى من نحن بالرئيسية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutUstxt_ar')) error @endif">
                                    {{ Form::textarea('AboutUstxt_ar',isset($setting['AboutUstxt_ar']->value) ? $setting['AboutUstxt_ar']->value : '',array('class'=>'form-control')) }}
                                </div>
                                @if ($errors->has('AboutUstxt_ar')) 
                                    <label id="AboutUstxt_ar-error" class="error" for="AboutUstxt_ar">{{ $errors->first('AboutUstxt_ar') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">مختصر إنجليزى من نحن بالرئيسية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutUstxt_en')) error @endif">
                                    {{ Form::textarea('AboutUstxt_en',isset($setting['AboutUstxt_en']->value) ? $setting['AboutUstxt_en']->value : '',array('class'=>'form-control')) }}
                                </div>
                                @if ($errors->has('AboutUstxt_en')) 
                                    <label id="AboutUstxt_en-error" class="error" for="AboutUstxt_en">{{ $errors->first('AboutUstxt_en') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">الصورة بالصفحة الرئيسية</h2>
                            <div class="form-group center">
                                <div id="AboutUsImage-holder" class="col-sm-12">
                                    @if(isset($setting['AboutUsImage']->value) && $setting['AboutUsImage']->value != '')
                                        <img src="{{ asset('storage/app/Settings/'.$setting['AboutUsImage']->value) }}" class="col-md-12">
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                                <div class="btn">
                                    <input id="AboutUsImageUpload" name="AboutUsImage" type="file">
                                </div>
                                @if ($errors->has('AboutUsImage')) 
                                    <label id="name-error" class="error" for="name">{{ $errors->first('AboutUsImage') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان المربع الأول باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox1Title_ar')) error @endif">
                                    {{ Form::text('AboutBox1Title_ar',isset($setting['AboutBox1Title_ar']->value) ? $setting['AboutBox1Title_ar']->value : '',array('id'=>'AboutBox1Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox1Title_ar'))
                                    <label id="AboutBox1Title_ar-error" class="error"
                                           for="AboutBox1Title_ar">{{ $errors->first('AboutBox1Title_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">عنوان المربع الأول باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox1Title_en')) error @endif">
                                    {{ Form::text('AboutBox1Title_en',isset($setting['AboutBox1Title_en']->value) ? $setting['AboutBox1Title_en']->value : '',array('id'=>'AboutBox1Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox1Title_en'))
                                    <label id="AboutBox1Title_en-error" class="error"
                                           for="AboutBox1Title_en">{{ $errors->first('AboutBox1Title_en') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الأول باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox1Txt_ar')) error @endif">
                                    {{ Form::textarea('AboutBox1Txt_ar',isset($setting['AboutBox1Txt_ar']->value) ? $setting['AboutBox1Txt_ar']->value : '',array('id'=>'AboutBox1Txt_ar','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox1Txt_ar'))
                                    <label id="AboutBox1Txt_ar-error" class="error"
                                           for="AboutBox1Txt_ar">{{ $errors->first('AboutBox1Txt_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الأول باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox1Txt_en')) error @endif">
                                    {{ Form::textarea('AboutBox1Txt_en',isset($setting['AboutBox1Txt_en']->value) ? $setting['AboutBox1Txt_en']->value : '',array('id'=>'AboutBox1Txt_en','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox1Txt_en'))
                                    <label id="AboutBox1Txt_en-error" class="error"
                                           for="AboutBox1Txt_en">{{ $errors->first('AboutBox1Txt_en') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان المربع الثانى باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox2Title_ar')) error @endif">
                                    {{ Form::text('AboutBox2Title_ar',isset($setting['AboutBox2Title_ar']->value) ? $setting['AboutBox2Title_ar']->value : '',array('id'=>'AboutBox2Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox2Title_ar'))
                                    <label id="AboutBox2Title_ar-error" class="error"
                                           for="AboutBox2Title_ar">{{ $errors->first('AboutBox2Title_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">عنوان المربع الثانى باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox2Title_en')) error @endif">
                                    {{ Form::text('AboutBox2Title_en',isset($setting['AboutBox2Title_en']->value) ? $setting['AboutBox2Title_en']->value : '',array('id'=>'AboutBox2Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox2Title_en'))
                                    <label id="AboutBox2Title_en-error" class="error"
                                           for="AboutBox2Title_en">{{ $errors->first('AboutBox2Title_en') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الثانى باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox2Txt_ar')) error @endif">
                                    {{ Form::textarea('AboutBox2Txt_ar',isset($setting['AboutBox2Txt_ar']->value) ? $setting['AboutBox2Txt_ar']->value : '',array('id'=>'AboutBox2Txt_ar','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox2Txt_ar'))
                                    <label id="AboutBox2Txt_ar-error" class="error"
                                           for="AboutBox2Txt_ar">{{ $errors->first('AboutBox2Txt_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الثانى باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox2Txt_en')) error @endif">
                                    {{ Form::textarea('AboutBox2Txt_en',isset($setting['AboutBox2Txt_en']->value) ? $setting['AboutBox2Txt_en']->value : '',array('id'=>'AboutBox2Txt_en','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox2Txt_en'))
                                    <label id="AboutBox2Txt_en-error" class="error"
                                           for="AboutBox2Txt_en">{{ $errors->first('AboutBox2Txt_en') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <h2 class="card-inside-title">عنوان المربع الثالث باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox3Title_ar')) error @endif">
                                    {{ Form::text('AboutBox3Title_ar',isset($setting['AboutBox3Title_ar']->value) ? $setting['AboutBox3Title_ar']->value : '',array('id'=>'AboutBox3Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox3Title_ar'))
                                    <label id="AboutBox3Title_ar-error" class="error"
                                           for="AboutBox3Title_ar">{{ $errors->first('AboutBox3Title_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">عنوان المربع الثالث باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox3Title_en')) error @endif">
                                    {{ Form::text('AboutBox3Title_en',isset($setting['AboutBox3Title_en']->value) ? $setting['AboutBox3Title_en']->value : '',array('id'=>'AboutBox3Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutBox3Title_en'))
                                    <label id="AboutBox3Title_en-error" class="error"
                                           for="AboutBox3Title_en">{{ $errors->first('AboutBox3Title_en') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الثالث باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox3Txt_ar')) error @endif">
                                    {{ Form::textarea('AboutBox3Txt_ar',isset($setting['AboutBox3Txt_ar']->value) ? $setting['AboutBox3Txt_ar']->value : '',array('id'=>'AboutBox3Txt_ar','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox3Txt_ar'))
                                    <label id="AboutBox3Txt_ar-error" class="error"
                                           for="AboutBox3Txt_ar">{{ $errors->first('AboutBox3Txt_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">محتوى المربع الثالث باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBox3Txt_en')) error @endif">
                                    {{ Form::textarea('AboutBox3Txt_en',isset($setting['AboutBox3Txt_en']->value) ? $setting['AboutBox3Txt_en']->value : '',array('id'=>'AboutBox3Txt_en','class'=>'form-control', 'placeholder'=>'', 'rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBox3Txt_en'))
                                    <label id="AboutBox3Txt_en-error" class="error"
                                           for="AboutBox3Txt_en">{{ $errors->first('AboutBox3Txt_en') }}</label>
                                @endif
                            </div>
                        </div>

                    </div>
                    {{ Form::submit('حفظ',array('value'=>'Submit','class'=>'btn bg-teal waves-effect')) }}

                </div>

            </div>

            <div class="card">
                <div class="header">
                    <h2>
                        إعدادات فريق العمل
                        <small>اتركه فارغا لتختفى فريق العمل</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="card-inside-title">عنوان مربع فريق العمل باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutTeamTitle_ar')) error @endif">
                                    {{ Form::text('AboutTeamTitle_ar',isset($setting['AboutTeamTitle_ar']->value) ? $setting['AboutTeamTitle_ar']->value : '',array('id'=>'AboutTeamTitle_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutTeamTitle_ar'))
                                    <label id="AboutTeamTitle_ar-error" class="error"
                                           for="AboutTeamTitle_ar">{{ $errors->first('AboutTeamTitle_ar') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">وصف مربع فريق العمل باللغة العربية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBoxTxt_ar')) error @endif">
                                    {{ Form::textarea('AboutBoxTxt_ar',isset($setting['AboutBoxTxt_ar']->value) ? $setting['AboutBoxTxt_ar']->value : '',array('id'=>'AboutBoxTxt_ar','class'=>'form-control', 'placeholder'=>'','rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBoxTxt_ar'))
                                    <label id="AboutBoxTxt_ar-error" class="error"
                                           for="AboutBoxTxt_ar">{{ $errors->first('AboutBoxTxt_ar') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="card-inside-title">عنوان مربع فريق العمل باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutTeamTitle_en')) error @endif">
                                    {{ Form::text('AboutTeamTitle_en',isset($setting['AboutTeamTitle_en']->value) ? $setting['AboutTeamTitle_en']->value : '',array('id'=>'AboutTeamTitle_en','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('AboutTeamTitle_en'))
                                    <label id="AboutTeamTitle_en-error" class="error"
                                           for="AboutTeamTitle_en">{{ $errors->first('AboutTeamTitle_en') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">وصف مربع فريق العمل باللغة الإنجليزية</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('AboutBoxTxt_en')) error @endif">
                                    {{ Form::textarea('AboutBoxTxt_en',isset($setting['AboutBoxTxt_en']->value) ? $setting['AboutBoxTxt_en']->value : '',array('id'=>'AboutBoxTxt_en','class'=>'form-control', 'placeholder'=>'','rows'=>'3')) }}
                                </div>
                                @if ($errors->has('AboutBoxTxt_en'))
                                    <label id="AboutBoxTxt_en-error" class="error"
                                           for="AboutBoxTxt_en">{{ $errors->first('AboutBoxTxt_en') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-6" style="border-left: solid 1px #f1f1f1;border-bottom: solid 1px #f1f1f1;padding:10px 0px;">
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الأول بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember1Name_ar')) error @endif">
                                        {{ Form::text('TeamMember1Name_ar',isset($setting['TeamMember1Name_ar']->value) ? $setting['TeamMember1Name_ar']->value : '',array('id'=>'TeamMember1Name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember1Name_ar'))
                                        <label id="TeamMember1Name_ar-error" class="error"
                                            for="TeamMember1Name_ar">{{ $errors->first('TeamMember1Name_ar') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الأول بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember1Title_ar')) error @endif">
                                        {{ Form::text('TeamMember1Title_ar',isset($setting['TeamMember1Title_ar']->value) ? $setting['TeamMember1Title_ar']->value : '',array('id'=>'TeamMember1Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember1Title_ar'))
                                        <label id="TeamMember1Title_ar-error" class="error"
                                            for="TeamMember1Title_ar">{{ $errors->first('TeamMember1Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الأول بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember1Name_en')) error @endif">
                                        {{ Form::text('TeamMember1Name_en',isset($setting['TeamMember1Name_en']->value) ? $setting['TeamMember1Name_en']->value : '',array('id'=>'TeamMember1Name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember1Name_en'))
                                        <label id="TeamMember1Name_en-error" class="error"
                                            for="TeamMember1Name_en">{{ $errors->first('TeamMember1Name_en') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الأول بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember1Title_en')) error @endif">
                                        {{ Form::text('TeamMember1Title_en',isset($setting['TeamMember1Title_en']->value) ? $setting['TeamMember1Title_en']->value : '',array('id'=>'TeamMember1Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember1Title_en'))
                                        <label id="TeamMember1Title_en-error" class="error"
                                            for="TeamMember1Title_en">{{ $errors->first('TeamMember1Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h2 class="card-inside-title">صورة العضو الأول</h2>
                            @if (isset($setting['TeamMember1Photo']->value) && $setting['TeamMember1Photo']->value != '')
                                <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember1Photo']->value) }}" alt="" class="col-sm-12">
                            @endif
                            <div class="form-group">
                                <input name="TeamMember1Photo" id="file-TeamMember1Photo" class="file" type="file">
                            </div>
                            <h2 class="card-inside-title">FB العضو الأول </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember1FB')) error @endif">
                                    {{ Form::text('TeamMember1FB',isset($setting['TeamMember1FB']->value) ? $setting['TeamMember1FB']->value : '',array('id'=>'TeamMember1FB','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember1FB'))
                                    <label id="TeamMember1FB-error" class="error"
                                        for="TeamMember1FB">{{ $errors->first('TeamMember1FB') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Twitter العضو الأول </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember1Twitter')) error @endif">
                                    {{ Form::text('TeamMember1Twitter',isset($setting['TeamMember1Twitter']->value) ? $setting['TeamMember1Twitter']->value : '',array('id'=>'TeamMember1Twitter','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember1Twitter'))
                                    <label id="TeamMember1Twitter-error" class="error"
                                        for="TeamMember1Twitter">{{ $errors->first('TeamMember1Twitter') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">GPlus العضو الأول </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember1GPlus')) error @endif">
                                    {{ Form::text('TeamMember1GPlus',isset($setting['TeamMember1GPlus']->value) ? $setting['TeamMember1GPlus']->value : '',array('id'=>'TeamMember1GPlus','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember1GPlus'))
                                    <label id="TeamMember1GPlus-error" class="error"
                                        for="TeamMember1GPlus">{{ $errors->first('TeamMember1GPlus') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Li العضو الأول </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember1Li')) error @endif">
                                    {{ Form::text('TeamMember1Li',isset($setting['TeamMember1Li']->value) ? $setting['TeamMember1Li']->value : '',array('id'=>'TeamMember1Li','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember1Li'))
                                    <label id="TeamMember1Li-error" class="error"
                                        for="TeamMember1Li">{{ $errors->first('TeamMember1Li') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6" style="border-bottom: solid 1px #f1f1f1;padding:10px 0px;">
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الثانى بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember2Name_ar')) error @endif">
                                        {{ Form::text('TeamMember2Name_ar',isset($setting['TeamMember2Name_ar']->value) ? $setting['TeamMember2Name_ar']->value : '',array('id'=>'TeamMember2Name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember2Name_ar'))
                                        <label id="TeamMember2Name_ar-error" class="error"
                                            for="TeamMember2Name_ar">{{ $errors->first('TeamMember2Name_ar') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الثانى بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember2Title_ar')) error @endif">
                                        {{ Form::text('TeamMember2Title_ar',isset($setting['TeamMember2Title_ar']->value) ? $setting['TeamMember2Title_ar']->value : '',array('id'=>'TeamMember2Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember2Title_ar'))
                                        <label id="TeamMember2Title_ar-error" class="error"
                                            for="TeamMember2Title_ar">{{ $errors->first('TeamMember2Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الثانى بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember2Name_en')) error @endif">
                                        {{ Form::text('TeamMember2Name_en',isset($setting['TeamMember2Name_en']->value) ? $setting['TeamMember2Name_en']->value : '',array('id'=>'TeamMember2Name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember2Name_en'))
                                        <label id="TeamMember2Name_en-error" class="error"
                                            for="TeamMember2Name_en">{{ $errors->first('TeamMember2Name_en') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الثانى بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember2Title_en')) error @endif">
                                        {{ Form::text('TeamMember2Title_en',isset($setting['TeamMember2Title_en']->value) ? $setting['TeamMember2Title_en']->value : '',array('id'=>'TeamMember2Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember2Title_en'))
                                        <label id="TeamMember2Title_en-error" class="error"
                                            for="TeamMember2Title_en">{{ $errors->first('TeamMember2Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h2 class="card-inside-title">صورة العضو الثانى</h2>
                            @if (isset($setting['TeamMember2Photo']->value) && $setting['TeamMember2Photo']->value != '')
                                <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember2Photo']->value) }}" alt="" class="col-sm-12">
                            @endif
                            <div class="form-group">
                                <input name="TeamMember2Photo" id="file-TeamMember2Photo" class="file" type="file">
                            </div>
                            <h2 class="card-inside-title">FB العضو الثانى </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember2FB')) error @endif">
                                    {{ Form::text('TeamMember2FB',isset($setting['TeamMember2FB']->value) ? $setting['TeamMember2FB']->value : '',array('id'=>'TeamMember2FB','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember2FB'))
                                    <label id="TeamMember2FB-error" class="error"
                                        for="TeamMember2FB">{{ $errors->first('TeamMember2FB') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Twitter العضو الثانى </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember2Twitter')) error @endif">
                                    {{ Form::text('TeamMember2Twitter',isset($setting['TeamMember2Twitter']->value) ? $setting['TeamMember2Twitter']->value : '',array('id'=>'TeamMember2Twitter','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember2Twitter'))
                                    <label id="TeamMember2Twitter-error" class="error"
                                        for="TeamMember2Twitter">{{ $errors->first('TeamMember2Twitter') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">GPlus العضو الثانى </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember2GPlus')) error @endif">
                                    {{ Form::text('TeamMember2GPlus',isset($setting['TeamMember2GPlus']->value) ? $setting['TeamMember2GPlus']->value : '',array('id'=>'TeamMember2GPlus','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember2GPlus'))
                                    <label id="TeamMember2GPlus-error" class="error"
                                        for="TeamMember2GPlus">{{ $errors->first('TeamMember2GPlus') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Li العضو الثانى </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember2Li')) error @endif">
                                    {{ Form::text('TeamMember2Li',isset($setting['TeamMember2Li']->value) ? $setting['TeamMember2Li']->value : '',array('id'=>'TeamMember2Li','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember2Li'))
                                    <label id="TeamMember2Li-error" class="error"
                                        for="TeamMember2Li">{{ $errors->first('TeamMember2Li') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6" style="border-left: solid 1px #f1f1f1;padding:10px 0px;">
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الثالث بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember3Name_ar')) error @endif">
                                        {{ Form::text('TeamMember3Name_ar',isset($setting['TeamMember3Name_ar']->value) ? $setting['TeamMember3Name_ar']->value : '',array('id'=>'TeamMember3Name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember3Name_ar'))
                                        <label id="TeamMember3Name_ar-error" class="error"
                                            for="TeamMember3Name_ar">{{ $errors->first('TeamMember3Name_ar') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الثالث بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember3Title_ar')) error @endif">
                                        {{ Form::text('TeamMember3Title_ar',isset($setting['TeamMember3Title_ar']->value) ? $setting['TeamMember3Title_ar']->value : '',array('id'=>'TeamMember3Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember3Title_ar'))
                                        <label id="TeamMember3Title_ar-error" class="error"
                                            for="TeamMember3Title_ar">{{ $errors->first('TeamMember3Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الثالث بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember3Name_en')) error @endif">
                                        {{ Form::text('TeamMember3Name_en',isset($setting['TeamMember3Name_en']->value) ? $setting['TeamMember3Name_en']->value : '',array('id'=>'TeamMember3Name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember3Name_en'))
                                        <label id="TeamMember3Name_en-error" class="error"
                                            for="TeamMember3Name_en">{{ $errors->first('TeamMember3Name_en') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الثالث بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember3Title_en')) error @endif">
                                        {{ Form::text('TeamMember3Title_en',isset($setting['TeamMember3Title_en']->value) ? $setting['TeamMember3Title_en']->value : '',array('id'=>'TeamMember3Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember3Title_en'))
                                        <label id="TeamMember3Title_en-error" class="error"
                                            for="TeamMember3Title_en">{{ $errors->first('TeamMember3Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h2 class="card-inside-title">صورة العضو الثالث</h2>
                            @if (isset($setting['TeamMember3Photo']->value) && $setting['TeamMember3Photo']->value != '')
                                <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember3Photo']->value) }}" alt="" class="col-sm-12">
                            @endif
                            <div class="form-group">
                                <input name="TeamMember3Photo" id="file-TeamMember3Photo" class="file" type="file">
                            </div>
                            <h2 class="card-inside-title">FB العضو الثالث </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember3FB')) error @endif">
                                    {{ Form::text('TeamMember3FB',isset($setting['TeamMember3FB']->value) ? $setting['TeamMember3FB']->value : '',array('id'=>'TeamMember3FB','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember3FB'))
                                    <label id="TeamMember3FB-error" class="error"
                                        for="TeamMember3FB">{{ $errors->first('TeamMember3FB') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Twitter العضو الثالث </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember3Twitter')) error @endif">
                                    {{ Form::text('TeamMember3Twitter',isset($setting['TeamMember3Twitter']->value) ? $setting['TeamMember3Twitter']->value : '',array('id'=>'TeamMember3Twitter','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember3Twitter'))
                                    <label id="TeamMember3Twitter-error" class="error"
                                        for="TeamMember3Twitter">{{ $errors->first('TeamMember3Twitter') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">GPlus العضو الثالث </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember3GPlus')) error @endif">
                                    {{ Form::text('TeamMember3GPlus',isset($setting['TeamMember3GPlus']->value) ? $setting['TeamMember3GPlus']->value : '',array('id'=>'TeamMember3GPlus','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember3GPlus'))
                                    <label id="TeamMember3GPlus-error" class="error"
                                        for="TeamMember3GPlus">{{ $errors->first('TeamMember3GPlus') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Li العضو الثالث </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember3Li')) error @endif">
                                    {{ Form::text('TeamMember3Li',isset($setting['TeamMember3Li']->value) ? $setting['TeamMember3Li']->value : '',array('id'=>'TeamMember3Li','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember3Li'))
                                    <label id="TeamMember3Li-error" class="error"
                                        for="TeamMember3Li">{{ $errors->first('TeamMember3Li') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6" style="padding:10px 0px;">
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الرابع بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember4Name_ar')) error @endif">
                                        {{ Form::text('TeamMember4Name_ar',isset($setting['TeamMember4Name_ar']->value) ? $setting['TeamMember4Name_ar']->value : '',array('id'=>'TeamMember4Name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember4Name_ar'))
                                        <label id="TeamMember4Name_ar-error" class="error"
                                            for="TeamMember4Name_ar">{{ $errors->first('TeamMember4Name_ar') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الرابع بالعربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember4Title_ar')) error @endif">
                                        {{ Form::text('TeamMember4Title_ar',isset($setting['TeamMember4Title_ar']->value) ? $setting['TeamMember4Title_ar']->value : '',array('id'=>'TeamMember4Title_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember4Title_ar'))
                                        <label id="TeamMember4Title_ar-error" class="error"
                                            for="TeamMember4Title_ar">{{ $errors->first('TeamMember4Title_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم العضو الرابع بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember4Name_en')) error @endif">
                                        {{ Form::text('TeamMember4Name_en',isset($setting['TeamMember4Name_en']->value) ? $setting['TeamMember4Name_en']->value : '',array('id'=>'TeamMember4Name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember4Name_en'))
                                        <label id="TeamMember4Name_en-error" class="error"
                                            for="TeamMember4Name_en">{{ $errors->first('TeamMember4Name_en') }}</label>
                                    @endif
                                </div>
                                <h2 class="card-inside-title">وظيفة العضو الرابع بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('TeamMember4Title_en')) error @endif">
                                        {{ Form::text('TeamMember4Title_en',isset($setting['TeamMember4Title_en']->value) ? $setting['TeamMember4Title_en']->value : '',array('id'=>'TeamMember4Title_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('TeamMember4Title_en'))
                                        <label id="TeamMember4Title_en-error" class="error"
                                            for="TeamMember4Title_en">{{ $errors->first('TeamMember4Title_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h2 class="card-inside-title">صورة العضو الرابع</h2>
                            @if (isset($setting['TeamMember4Photo']->value) && $setting['TeamMember4Photo']->value != '')
                                <img src="{{ URL::to('storage/app/Settings/'.$setting['TeamMember4Photo']->value) }}" alt="" class="col-sm-12">
                            @endif
                            <div class="form-group">
                                <input name="TeamMember4Photo" id="file-TeamMember4Photo" class="file" type="file">
                            </div>
                            <h2 class="card-inside-title">FB العضو الرابع </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember4FB')) error @endif">
                                    {{ Form::text('TeamMember4FB',isset($setting['TeamMember4FB']->value) ? $setting['TeamMember4FB']->value : '',array('id'=>'TeamMember4FB','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember4FB'))
                                    <label id="TeamMember4FB-error" class="error"
                                        for="TeamMember4FB">{{ $errors->first('TeamMember4FB') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Twitter العضو الرابع </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember4Twitter')) error @endif">
                                    {{ Form::text('TeamMember4Twitter',isset($setting['TeamMember4Twitter']->value) ? $setting['TeamMember4Twitter']->value : '',array('id'=>'TeamMember4Twitter','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember4Twitter'))
                                    <label id="TeamMember4Twitter-error" class="error"
                                        for="TeamMember4Twitter">{{ $errors->first('TeamMember4Twitter') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">GPlus العضو الرابع </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember4GPlus')) error @endif">
                                    {{ Form::text('TeamMember4GPlus',isset($setting['TeamMember4GPlus']->value) ? $setting['TeamMember4GPlus']->value : '',array('id'=>'TeamMember4GPlus','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember4GPlus'))
                                    <label id="TeamMember4GPlus-error" class="error"
                                        for="TeamMember4GPlus">{{ $errors->first('TeamMember4GPlus') }}</label>
                                @endif
                            </div>
                            <h2 class="card-inside-title">Li العضو الرابع </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('TeamMember4Li')) error @endif">
                                    {{ Form::text('TeamMember4Li',isset($setting['TeamMember4Li']->value) ? $setting['TeamMember4Li']->value : '',array('id'=>'TeamMember4Li','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('TeamMember4Li'))
                                    <label id="TeamMember4Li-error" class="error"
                                        for="TeamMember4Li">{{ $errors->first('TeamMember4Li') }}</label>
                                @endif
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
