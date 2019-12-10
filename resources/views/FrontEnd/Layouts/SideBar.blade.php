<div class="col-lg-4 p-l-0">
    <div style="padding:15px;text-align:center;border:solid 1px #ccc;margin-bottom:10px;">
        <h4 class="bg-primary-color text-white p-10">عدد الزيارات</h4>
        <!-- Start of WebFreeCounter Code -->
        <img src="https://www.webfreecounter.com/hit.php?id=zrruuxxxx&nd=6&style=63" border="0" alt="visitor counter">
        <!-- End of WebFreeCounter Code -->
    </div>
<?php
$widgets = \App\Widget::where('status', '=', 'active')
    ->orderBy('number', 'asc')
    ->orderBy('id', 'desc')
    ->get();
?>
@foreach($widgets as $widget)
    <!-- ads -->
        @if($widget->type =='ad')
            <?php
            $sideAd = \App\Ad::where('status', '=', 'active')
                ->where('publishTime', '<=', strtotime('now'))
                ->where('expireTime', '>=', strtotime('now'))
                ->where('type', '=', 'sidebar')
                ->where('id', '=', $widget->ad_id)
                ->orderByRaw('RAND()')
                ->first();
            ?>
            <div class="banner m-b-20 text-center">
                @if($sideAd != '')
                    @if($sideAd -> code != '')
                        {!! html_entity_decode($sideAd->code) !!}
                    @else

                        <a href="{{url('/VisitAd/'.$sideAd->id)}}" target="_blank">
                            <img src="{{asset('/storage/app/ads/'.$sideAd->id.'/'.$sideAd->image)}}"
                                 alt="{{$sideAd->name}}">
                            <!-- 350*350 -->
                        </a>
                    @endif
                @else
                    <a href="#" target="_blank">
                        <img src="{{URL::to('/')}}/SiteAssets/style/images/banner3.png"
                             alt="{{$setting['title']->value}}">
                        <!-- 350*350 -->
                    </a>
                @endif
            </div>
            <!-- questionnaire -->
        @elseif($widget->type =='questionnaire')
            <?php
            $sideQuestionnaire = \App\Questionnaire::where('id', '=', $widget->questionnaire_id)
                ->where('status', '=', 'active')
                ->where('publishTime', '<=', strtotime('now'))
                ->where('expireTime', '>=', strtotime('now'))
                ->first();
            ?>
            @if($sideQuestionnaire != '')
                <div class="polls bg-light m-b-20">
                    <h4 class="bg-primary-color text-white p-10">
                        <a href="{{url('/Questionnaire')}}" class="text-white">{{$widget->name}}</a>
                    </h4>
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
            @endif
        <!-- slider -->
        @elseif($widget->type =='slider')
            <?php
            if ($widget->query_type == 'most_viewed') {
                $columnForOrder = 'visits';
            } else {
                $columnForOrder = 'id';
            }
            if ($widget->category_id == '') {
                $sideSliderArticles = \App\Article::where('status', '=', 'published')
                    ->orderBy($columnForOrder, 'desc')
                    ->take($widget->count)
                    ->get();
            } else {
                $sideSliderArticles = \App\Article::where('status', '=', 'published')
                    ->where('category_id', '=', $widget->category_id)
                    ->orderBy($columnForOrder, 'desc')
                    ->take($widget->count)
                    ->get();
            }
            ?>
            @if(count($sideSliderArticles) != 0)
                <div class="gallery m-b-20">
                    <h5 class="title bg-primary-color text-white p-10">{{$widget->name}}</h5>
                    <div class="owl-carousel owl-demo owl-theme p-10">
                        @foreach($sideSliderArticles as $sideSliderArticle)
                            <div class="item">
                                <img src="{{asset('/storage/app/articles/'.$sideSliderArticle->id.'/'.$sideSliderArticle->image)}}"
                                     alt="{{$sideSliderArticle->name}}">
                                <div class="overlay">
                                    <a href="{{url('/Categories/'.$sideSliderArticle->category_id.'/Articles/'.$sideSliderArticle->id.'/'.$sideSliderArticle->slug)}}">
                                        {{\Illuminate\Support\Str::limit(strip_tags($sideSliderArticle->summary != '' ? $sideSliderArticle->summary :$sideSliderArticle->description),150)}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        <!-- articles-->
        @elseif($widget->type =='articles')
            <?php
            if ($widget->query_type == 'most_viewed') {
                $columnForOrder = 'visits';
            } else {
                $columnForOrder = 'id';
            }
            if ($widget->category_id == '') {
                $slideListArticles = \App\Article::where('status', '=', 'published')
                    ->orderBy($columnForOrder, 'desc')
                    ->take($widget->count)
                    ->get();
            } else {
                $slideListArticles = \App\Article::where('status', '=', 'published')
                    ->where('category_id', '=', $widget->category_id)
                    ->orderBy($columnForOrder, 'desc')
                    ->take($widget->count)
                    ->get();
            }
            ?>

            @if(count($slideListArticles) != 0)
                <div class="most-read m-b-20">
                    <h5 class="title bg-primary-color text-white p-10">{{$widget->name}}</h5>
                    @foreach($slideListArticles as $slideListArticle)
                        <article>
                            <a href="{{url('/Categories/'.$slideListArticle->category_id.'/Articles/'.$slideListArticle->id.'/'.$slideListArticle->slug)}}"
                               class="float-right image">
                                <img src="{{asset('/storage/app/articles/'.$slideListArticle->id.'/'.$slideListArticle->image)}}"
                                     alt="{{$slideListArticle->name}}"/>
                            </a>
                            <div class="txt float-right">
                                <a href="{{url('/Categories/'.$slideListArticle->category_id.'/Articles/'.$slideListArticle->id.'/'.$slideListArticle->slug)}}"
                                   class="primary-color d-block">
                                    {{$slideListArticle->name}}
                                </a>
                                <div class="views text-muted f-s-12">عدد المشاهدات: {{$slideListArticle->visits}}</div>
                            </div>
                            <div class="clearfix"></div>
                        </article>
                    @endforeach
                </div>
            @endif
        @else
            <?php
            $sideFeatureArticle = \App\Article::where('status', '=', 'published')
                ->where('id', '=', $widget->article_id)
                ->first();

            ?>
        <!-- feature_article -->
            @if($sideFeatureArticle != '')
                <div class="editor m-b-20">
                    <h5 class="title bg-primary-color text-white p-10">{{$widget->name}}</h5>
                    <div class="image">
                        <a href="{{url('/Categories/'.$sideFeatureArticle->category_id.'/Articles/'.$sideFeatureArticle->id.'/'.$sideFeatureArticle->slug)}}"
                           class="primary-color">
                            <img src="{{asset('/storage/app/articles/'.$sideFeatureArticle->id.'/'.$sideFeatureArticle->image)}}"
                                 alt="{{$sideFeatureArticle->name}}">
                        </a>
                    </div>
                    <div class="txt p-20 bg-light">
                        <a href="{{url('/Categories/'.$sideFeatureArticle->category_id.'/Articles/'.$sideFeatureArticle->id.'/'.$sideFeatureArticle->slug)}}"
                           class="primary-color">
                            <h5>{{$sideFeatureArticle->name}}</h5>
                        </a>
                        {{\Illuminate\Support\Str::limit(strip_tags($sideFeatureArticle->description),700)}}

                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>
