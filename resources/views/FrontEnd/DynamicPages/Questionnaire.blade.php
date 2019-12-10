@extends('FrontEnd.Layouts.Master')

@section('content')
    <?php
    $setting = \App\Setting::get()->keyBy('key')->all();
    if ($setting['logo']->value != '') {
        $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
    } else {
        $logo_path = '/SiteAssets/style/images/logo.png';
    }

    ?>
    <main>
        <div class="row m-0">

            @include('FrontEnd.Layouts.RightBanner')

            <div class="col-sm-8 col-9 content m-t-30">
                <div class="row">
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">الرئيسيه</a>
                                </li>

                                <li class="breadcrumb-item active"
                                    aria-current="page">استفتاءات الأفضل</li>
                            </ol>
                        </nav>

                        <div class="single">
                            <article>
                                <div class="page-content">
                                    @forelse($questionnaires as $sideQuestionnaire)
                                    <div class="polls bg-light m-b-20">
                                        <form action="{{url('/Questionnaire/'.$sideQuestionnaire->id.'/Vote')}}" method="post">
                                            {!! csrf_field() !!}
                                            <label class="primary-color poll-title">{{$sideQuestionnaire->q}}</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="vote" required id="poll1" value="a1"
                                                        {{\App\QuestionnaireVote::where('questionnaire_id','=',$sideQuestionnaire->id)->where('value','=','a1')->where('session_id','=',Session::getId())->exists() ? 'checked' : ''}}
                                                >
                                                <label class="form-check-label" for="poll1">
                                                    {{$sideQuestionnaire->a1}}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="vote" required id="poll2" value="a2"
                                                        {{\App\QuestionnaireVote::where('questionnaire_id','=',$sideQuestionnaire->id)->where('value','=','a2')->where('session_id','=',Session::getId())->exists() ? 'checked' : ''}}
                                                >
                                                <label class="form-check-label" for="poll2">
                                                    {{$sideQuestionnaire->a2}}
                                                </label>
                                            </div>
                                            @if($sideQuestionnaire->a3 != '')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vote" required id="poll3" value="a3"
                                                            {{\App\QuestionnaireVote::where('questionnaire_id','=',$sideQuestionnaire->id)->where('value','=','a3')->where('session_id','=',Session::getId())->exists() ? 'checked' : ''}}
                                                    >
                                                    <label class="form-check-label" for="poll3">
                                                        {{$sideQuestionnaire->a3}}
                                                    </label>
                                                </div>
                                            @endif
                    
                                            @if($sideQuestionnaire->a4 != '')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vote" required id="poll4" value="a4"
                                                            {{\App\QuestionnaireVote::where('questionnaire_id','=',$sideQuestionnaire->id)->where('value','=','a4')->where('session_id','=',Session::getId())->exists() ? 'checked' : ''}}
                                                    >
                                                    <label class="form-check-label" for="poll4">
                                                        {{$sideQuestionnaire->a4}}
                                                    </label>
                                                </div>
                                            @endif
                    
                    
                                            @if($sideQuestionnaire->a5 != '')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="vote" required id="poll5" value="a5"
                                                            {{\App\QuestionnaireVote::where('questionnaire_id','=',$sideQuestionnaire->id)->where('value','=','a5')->where('session_id','=',Session::getId())->exists() ? 'checked' : ''}}
                                                    >
                                                    <label class="form-check-label" for="poll5">
                                                        {{$sideQuestionnaire->a5}}
                                                    </label>
                                                </div>
                                            @endif
                    
                                            <div class="result collapse p-20" id="collapse{{$sideQuestionnaire->id}}">
                                                <?php
                                                $totalVote = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->get()->count();
                                                $a1Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a1')->get()->count();
                                                $a2Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a2')->get()->count();
                                                $a3Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a3')->get()->count();
                                                $a4Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a4')->get()->count();
                                                $a4Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a4')->get()->count();
                                                $a5Votes = \App\QuestionnaireVote::where('questionnaire_id', '=', $sideQuestionnaire->id)
                                                    ->where('value', '=', 'a5')->get()->count();
                    
                                                if ($totalVote != 0) {
                                                    $a1Result = $a1Votes / $totalVote * 100;
                                                    $a2Result = $a2Votes / $totalVote * 100;
                                                    $a3Result = 0;
                                                    if ($sideQuestionnaire->a3 != '') {
                                                        $a3Result = $a3Votes / $totalVote * 100;
                                                    }
                                                    $a4Result = 0;
                                                    if ($sideQuestionnaire->a4 != '') {
                                                        $a4Result = $a4Votes / $totalVote * 100;
                                                    }
                                                    $a5Result = 0;
                                                    if ($sideQuestionnaire->a5 != '') {
                                                        $a5Result = $a5Votes / $totalVote * 100;
                                                    }
                                                } else {
                                                    $a1Result = 0;
                                                    $a2Result = 0;
                                                    $a3Result = 0;
                                                    $a4Result = 0;
                                                    $a5Result = 0;
                                                }
                                                ?>
                                                <div class="progress-content">
                                                    <span class="float-right f-s-14">{{$sideQuestionnaire->a1}}</span>
                                                    <span class="float-left f-s-12">
                                                        {{$a1Result}}%
                                                    </span>
                                                    <div class="clearfix"></div>
                                                    <div class="progress m-b-15 m-t-10">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{$a1Result }}%"
                                                             aria-valuenow="{{$a1Result }}"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-content">
                                                    <span class="float-right f-s-14">{{$sideQuestionnaire->a2}}</span>
                                                    <span class="float-left f-s-12">{{$a2Result}}%</span>
                                                    <div class="clearfix"></div>
                                                    <div class="progress m-b-15 m-t-10">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{$a2Result }}%"
                                                             aria-valuenow="{{$a2Result }}"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                @if($sideQuestionnaire->a3 != '')
                                                    <div class="progress-content">
                                                        <span class="float-right f-s-14">{{$sideQuestionnaire->a3}}</span>
                                                        <span class="float-left f-s-12">{{$a3Result}}%</span>
                                                        <div class="clearfix"></div>
                                                        <div class="progress m-b-15 m-t-10">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{$a3Result }}%"
                                                                 aria-valuenow="{{$a3Result}}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($sideQuestionnaire->a4 != '')
                                                    <div class="progress-content">
                                                        <span class="float-right f-s-14">{{$sideQuestionnaire->a4}}</span>
                                                        <span class="float-left f-s-12">{{$a4Result}}%</span>
                                                        <div class="clearfix"></div>
                                                        <div class="progress m-b-15 m-t-10">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{$a4Result}}%"
                                                                 aria-valuenow="{{$a4Result }}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($sideQuestionnaire->a5 != '')
                                                    <div class="progress-content">
                                                        <span class="float-right f-s-14">{{$sideQuestionnaire->a5}}</span>
                                                        <span class="float-left f-s-12">{{$a5Result}}%</span>
                                                        <div class="clearfix"></div>
                                                        <div class="progress m-b-15 m-t-10">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{$a5Result }}%"
                                                                 aria-valuenow="{{$a5Result}}"
                                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                    
                                            <div class="text-center m-t-15">
                                                <button type="submit" class="btn bg-primary-color text-white">تصويت</button>
                                                <a href="#collapse{{$sideQuestionnaire->id}}" data-toggle="collapse"
                                                   class="btn bg-secondary-color text-white">النتائج</a>
                                            </div>
                                        </form>
                                    </div>
                                    @empty
                                    
                                    @endforelse
                                </div>
                            </article>

                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style float-right">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                                <a class="a2a_button_google_gmail"></a>
                                <a class="a2a_button_linkedin"></a>
                                <a class="a2a_button_copy_link"></a>
                                <a class="a2a_button_facebook_messenger"></a>
                            </div>
                            <div class="clearfix"></div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                        </div>


                    </div>

                    @include('FrontEnd.Layouts.SideBar')

                </div>
                <!-- ads -->
                <div class="banner text-center m-b-20">
                    <?php
                    $footerAd = \App\Ad::where('status', '=', 'active')
                        ->where('publishTime', '<=', strtotime('now'))
                        ->where('expireTime', '>=', strtotime('now'))
                        ->where('type', '=', 'pages')
                        ->orderByRaw('RAND()')
                        ->first();
                    ?>
                    @if($footerAd != '')
                        @if($footerAd -> code != '')
                            {!! html_entity_decode($footerAd->code) !!}
                        @else
                            <a href="{{url('/VisitAd/'.$footerAd->id)}}" target="_blank">
                                <img src="{{asset('/storage/app/ads/'.$footerAd->id.'/'.$footerAd->image)}}"
                                     alt="{{$footerAd->name}}">
                                <!-- 728*90 -->
                            </a>
                        @endif
                    @else
                        <a href="#" target="_blank">
                            <img src="{{URL::to('/')}}/SiteAssets/style/images/cat-banner1.png" alt="{{$setting['title']->value}}">
                            <!-- 728*90 -->
                        </a>
                    @endif
                </div>

            </div>
            @include('FrontEnd.Layouts.LeftBanner')

        </div>

    </main>

@endsection