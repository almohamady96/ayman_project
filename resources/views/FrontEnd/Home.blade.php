@extends('FrontEnd.Layouts.Master')
<?php
$Setting = \App\Setting::get()->keyBy('key')->all();

?>
@section('content')

    <section>
        @if(isset($Setting['s1img']->value) && $Setting['s1img']->value != '' && $Setting['s1Title_'.Session::get('Lang')]->value != '')
            <!-- slider -->
                <section class="slider carousel slide" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                            $SlideX = 0;
                            for ($i=1; $i <= 5; $i++) { 
                                $ThisServiceTitle = $Setting['s'.$i.'Title_'.Session::get('Lang')]->value;
                        ?>
                            @if($ThisServiceTitle != '')
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$SlideX}}" @if($SlideX == 0) class="active" @endif ></li>
                            @endif
                        <?php
                                $SlideX++;
                            }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                            $SlideX = 0;
                            for ($i=1; $i <= 5; $i++) { 
                                $ThisServiceTitle = $Setting['s'.$i.'Title_'.Session::get('Lang')]->value;
                                if ($ThisServiceTitle) {
                                    $ImgURL = asset('storage/app/Settings/'.$Setting['s'.$i.'img']->value);
                                    $ThisServiceTxt = $Setting['s'.$i.'Txt_'.Session::get('Lang')]->value;
                        ?>
                            @if($ThisServiceTitle != '')
                                <div class="carousel-item @if($SlideX == 0) active @endif ">
                                    <img class="d-block mx-auto zoomslider" src="{{$ImgURL}}" alt="{{$ThisServiceTitle}}">
                                    <div class="carousel-caption d-none d-md-block text-right wow zoomIn">
                                        <h2 class="prime-color bold m-b-25">{{$ThisServiceTitle}}</h2>
                                        @if($ThisServiceTxt != '')
                                            <p>
                                                {{$ThisServiceTxt}}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="slider-btns">
                                        <a href="{{url('/Registeration/PersonalTraining')}}" class="btn d-inline-block btn-success wow bounceInLeft" animation-delay="1s" data-wow-delay="0.5s">تدريب أفراد</a>
                                        <div class="clearfix m-t-10"></div>
                                        <a href="{{url('/Registeration/CompaniesTraining')}}" class="btn d-inline-block btn-primary wow bounceInLeft" animation-delay="1.5s" data-wow-delay="0.5s">تدريب شركات</a>
                                        <div class="clearfix m-t-10"></div>
                                        <a href="{{url('/Registeration/RegisterTrainer')}}" class="btn d-inline-block btn-danger wow bounceInLeft" animation-delay="2s" data-wow-delay="0.5s"> قدم كمحاضر</a>
                                    </div>
                                </div>
                            @endif
                        <?php
                                $SlideX++;
                                }
                            }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </section>
            <!-- #END# slider -->
        @else
        @endif
        <!-- about -->
            <section class="about container sec-padding">
                <div class="title text-center m-b-40">
                    <h3 class="prime-color header-title zoomIn" animation-delay="1s" data-wow-delay="0.5s">{{$Setting['title']->value}}</h3>
                </div>
                <div class="row justify-content-center no-margin m-t-25 wow">
                    <?php
                        for ($i=1; $i <= 4; $i++) { 
                            $ImgURL = asset('storage/app/Settings/'.$Setting['Service'.$i.'img']->value);
                            $ThisServiceTitle = $Setting['Service'.$i.'Title_'.Session::get('Lang')]->value;
                            $ThisServiceTxt = $Setting['Service'.$i.'Txt_'.Session::get('Lang')]->value;
                    ?>
                        @if($ThisServiceTitle != '')
                            <div class="col-lg-3 col-md-4 col-sm-6 col-11 service text-center m-b-30 wow zoomIn" animation-delay="1s" data-wow-delay="0.5s">
                                <figure>
                                    <img src="{{$ImgURL}}" alt="">
                                </figure>
                                <h4 class="prime-color m-b-15">{{$ThisServiceTitle}}</h4>
                                <p>
                                    {{$ThisServiceTxt}}
                                </p>
                            </div>
                        @endif
                    <?php
                        }
                    ?>
                </div>
            </section>
        <!-- #END# -->
        <!-- services -->
            <section class="services sec-padding">
                <div class="container">
                    <div class="text-center m-b-20">
                        <h2 class="header-title">الدورات التدريبية</h2>
                    </div>
                    <ul class="coursesSec-owl-demo nav nav-pills mb-3 justify-content-center text-center" id="pills-tab" role="tablist" dir="ltr">
                        <li class="nav-item item">
                            <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="true" aria-expanded="true">جميع الدورات</a>
                        </li>
                        <?php
                            $ServicesSections = App\ServicesSections::orderBy('Ordered','asc')->get();
                            $FirstServices = App\Services::orderBy('id','desc')->get()->take(8);
                        ?>
                        @foreach($ServicesSections as $Section)
                            <li class="nav-item item">
                                <a class="nav-link" id="pills-tab{{$Section->id}}-tab" data-toggle="pill" href="#pills-tab{{$Section->id}}" role="tab" aria-controls="pills-tab{{$Section->id}}" aria-selected="false" aria-expanded="false">
                                    {{$Section['Title_'.Session::get('Lang')]}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content p-t-20" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab" aria-expanded="true">
                            <div class="row justify-content-center">
                                @foreach($FirstServices as $Service)
                                    <?php 
                                        $string = str_replace('/', '-', $Service['Title_'.Session::get('Lang')]); // Replaces all spaces with hyphens.
                                        $linkTitle = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-11 m-b-30">
                                        <article class="simple-shadow">
                                            <figure>
                                                <a href="{{url('/CourcesCate/'.$Service->SectionID.'/Cource/'.$Service->id.'/'.$linkTitle)}}">
                                                    @if($Service->photo != '')
                                                        <img src="{{ asset('storage/app/public/Services/'.$Service->id.'/'.$Service->photo) }}" alt="{{$Service['Title_'.Session::get('Lang')]}}">
                                                    @else
                                                        <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/no-image.png" alt="{{$Service['Title_'.Session::get('Lang')]}}">
                                                    @endif
                                                </a>
                                            </figure>
                                            <div class="text bg-light p-15">
                                                <a href="{{url('/CourcesCate/'.$Service->SectionID.'/Cource/'.$Service->id.'/'.$linkTitle)}}" class="f-s-18 prime-color">
                                                    {{$Service['Title_'.Session::get('Lang')]}}
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @foreach($ServicesSections as $Section)
                            <div class="tab-pane fade" id="pills-tab{{$Section->id}}" role="tabpanel" aria-labelledby="pills-tab{{$Section->id}}-tab" aria-expanded="false">
                                <div class="row justify-content-center">
                                    <?php
                                        $SectionServices = App\Services::where('SectionID',$Section->id)->orderBy('id','desc')->get()->take(8);
                                    ?>
                                    @foreach($SectionServices as $Service)
                                        <?php 
                                            $string = str_replace('/', '-', $Service['Title_'.Session::get('Lang')]); // Replaces all spaces with hyphens.
                                            $linkTitle = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-11 m-b-30">
                                            <article class="simple-shadow">
                                                <figure>
                                                    <a href="{{url('/CourcesCate/'.$Service->SectionID.'/Cource/'.$Service->id.'/'.$linkTitle)}}">
                                                        @if($Service->photo != '')
                                                            <img src="{{ asset('storage/app/public/Services/'.$Service->id.'/'.$Service->photo) }}" alt="{{$Service['Title_'.Session::get('Lang')]}}">
                                                        @else
                                                            <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/no-image.png" alt="{{$Service['Title_'.Session::get('Lang')]}}">
                                                        @endif
                                                    </a>
                                                </figure>
                                                <div class="text bg-light p-15">
                                                    <a href="{{url('/CourcesCate/'.$Service->SectionID.'/Cource/'.$Service->id.'/'.$linkTitle)}}" class="f-s-18 prime-color">
                                                        {{$Service['Title_'.Session::get('Lang')]}}
                                                    </a>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                   <div class="text-center">
                        <a href="{{url('/Cources/الدورات-التدريبية')}}" class="btn btn-prime wow zoomIn m-t-25" animation-delay="1s" data-wow-delay="1.3s" >{{trans('Site.More')}}</a>
                   </div>
                </div>
                
            </section>
        <!-- #END# services -->
        @if($Setting['VideoFile']->value != '')
            <!-- video -->
                <section class="video text-center">
                    <div class="overlay p-t-50 p-b-50 d-flex justify-content-center align-items-center">
                        <div class="container">
                            <!--<svg class="svg-inline--fa fa-play-circle fa-w-16 wow zoomIn" animation-delay="1s" data-wow-delay="0.5s" aria-hidden="true" data-prefix="fas" data-icon="play-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm115.7 272l-176 101c-15.8 8.8-35.7-2.5-35.7-21V152c0-18.4 19.8-29.8 35.7-21l176 107c16.4 9.2 16.4 32.9 0 42z"></path></svg> -->
                            <i class="fas fa-play-circle wow zoomIn" animation-delay="1s" data-wow-delay="0.5s"></i>
                            <div class="d-block text-white m-t-50 m-b-50">
                                <div class="section-header wow zoomIn" animation-delay="1s" data-wow-delay="0.9s">
                                    <h2 class="bold m-t-25 m-b-25">{!!$Setting['PromoTxt_'.Session::get('Lang')]->value!!}</h2>
                                </div>
                            </div>
                            <button type="button" class="btn btn-white wow zoomIn m-t-25" animation-delay="1s" data-wow-delay="1.3s" data-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#myModal" style="cursor: pointer; visibility: visible; animation-delay: 1.3s; animation-name: zoomIn;">
                                شاهد الفيديو
                            </button>

                            <div class="modal fade login-modal bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="myStopClickButton">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="video-modal">
                                                <video controls="controls" width="100%"height="100%" name="media">
                                                    <source src="{{URL::to('/')}}/storage/app/Settings/{{$Setting['VideoFile']->value}}" autostart="false" type="video/mp4" style="max-height:95% !important;">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </section>
            <!-- #END# video -->
        @endif

        <?php
            $HomeArticles = App\Article::orderBy('id', 'desc')->get()->take(3);
        ?>
        @if(count($HomeArticles) > 0)
        <section class="blog container p-t-50 p-b-50 sec-padding">
            <div class="title text-center m-b-40">
                <h3 class="primary-color  header-title">اخر الاخبار</h3>
            </div>
            <div class="row no-margin">
                @foreach($HomeArticles as $article)
					<div class="col-lg-4 col-md-6 col-sm-9">
						<article class="m-b-30">
							<div class="image">
								<a href="{{url('/Categories/'.$article->category_id.'/Articles/'.$article->id.'/'.$article->slug)}}">
									@if($article->image != '')
										<img src="{{asset('/storage/app/articles/'.$article->id.'/'.$article->image)}}" alt="{{$article->name_ar}}">
									@endif
								</a>
							</div>
							<div class="txt m-t-30">
								<a href="{{url('/Categories/'.$article->category_id.'/Articles/'.$article->id.'/'.$article->slug)}}" class="primary-color primary-color-hover">
									{{$article->name_ar}}
								</a>
								<ul class="p-0 m-t-10">
									<li>
										<i class="fa fa-calendar"></i>
										<span>
											@if(Session::get('Lang') == 'ar')
												{{ \App\Classes\ArabicDate::GetDate($article['created_at']) }}
											@else
												{{ $Article['created_at'] }}
											@endif
										</span>
									</li>
								</ul>
								<p>
									{!! illuminate\support\Str::words(html_entity_decode(strip_tags($article['description_'.Session::get('Lang')])), $words = 100, $end = ' ...') !!}
								</p>
							</div>
						</article>
					</div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{url('Categories/1/أخبار')}}" class="btn btn-prime wow zoomIn m-t-25" animation-delay="1s" data-wow-delay="1.3s" >{{trans('Site.More')}}</a>
            </div>
        </section>
        <?php /*
        <!-- news -->
            <section class="videos container sec-padding ">
                <div class="owl-demo">
                    @foreach($HomeArticles as $Article)
                        <div class="item">
                            <a href="{{url('/Categories/'.$Article->category_id.'/Articles/'.$Article->id.'/'.$Article->slug)}}">
                                <figure class="m-b-0">
                                    <img src="{{asset('/storage/app/articles/'.$Article->id.'/'.$Article->image)}}" alt=""> 
                                    <figcaption>
                                        <i class="far fa-play-circle"></i>
                                    </figcaption>
                                </figure>
                                <h5 class="txt bg-light p-15 text-right ">{{$Article->name_ar}}</h5>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                        <a href="{{url('Articles/كل-المقالات')}}" class="btn btn-prime wow zoomIn m-t-25" animation-delay="1s" data-wow-delay="1.3s" >{{trans('Site.More')}}</a>
                </div>
            </section>
        <!-- #END# news -->
        */ ?>
        @endif
        <!-- numbers -->
        <section class="success text-white ">
            <div class="overlay2 sec-padding">
                <div class="container">
                    <div class="row num text-center">
                        <?php
                            for ($i=1; $i <= 4; $i++) { 
                                $ThisNoTxt = $Setting['No'.$i.'Txt_'.Session::get('Lang')]->value;
                        ?>
                            @if($ThisNoTxt != '')
                                <div class="col-lg-3 col-md-3 col-6">
                                    <div class="counter">
                                        <div class="counter-value d-block f-s-50" data-count="{{$Setting['No'.$i.'Number']->value}}">{{$Setting['No'.$i.'Number']->value}}</div>
                                        <span class="f-s-25">{{$ThisNoTxt}}</span>
                                    </div>
                                </div>
                            @endif
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- #END# numbers -->

        <?php
            $Gallery = App\Image::where('type', '=', 'partner')
                                ->orderBy('number', 'asc')
                                ->orderBy('id', 'desc')
                                ->get()
                                ->take(8);
        ?>
        @if(count($Gallery) > 0)
        <!-- partners -->
            <section class="partners container m-t-40 m-b-40 text-center">
                <div class="text-center m-b-20 wow zoomIn" animation-delay="1s" data-wow-delay="0.4s">
                    <h2 class="bold header-title">شركاء النجاح</h2>
                </div>
                <div class="owl-demo partners-owl-demo">
                    @foreach($Gallery as $Photo)
                        <div class="item">
                            <a href="{{$Photo->name}}" target="_blank">
                                <img src="{{URL::to('storage/app/partners/' . $Photo->id . '/' . $Photo->file)}}" alt="Owl Image">
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        <!-- #END# partners -->
        @endif
        <?php
            $quotes = App\Quote::orderBy('id', 'desc')->get();
            $X = 0;
        ?>
        @if(count($quotes) > 0)
            <!-- testimonials -->
            <section class=" testimonials m-t-20 m-b-40 text-center">
                <div class="overlay2">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="qute text-white col-sm-12">
                            <h2 class="bold text-center text-white">ماذا يقول عملائنا</h2>
                            <div id="carouselExampleIndicators2" class="carousel slide col-sm-12" data-ride="carousel">
                                <div class="carousel-inner m-t-50 col-sm-12">
                                    <?php $X = 0; ?>
                                    @foreach($quotes as $quote)
                                        <div class="carousel-item @if($X == 0) active @endif col-sm-12">
                                            <div class="carousel-content">
                                                <div class="image">
                                                    @if($quote->file != '')
                                                        <img src="{{asset('/storage/app/Quotes/'.$quote->id.'/'.$quote->file)}}" alt="">
                                                    @else
                                                        <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/client-1.jpg" alt="">
                                                    @endif
                                                </div>
                                                <h4>{{$quote->name}}</h4>
                                                <date>{{date('d/m/Y',strtotime($quote->created_at))}}</date>
                                                <div class="m-t-20">
                                                    <p>
                                                        {{$quote->content}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $X++; ?>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- #END testimonials -->
        @endif

    </section>

    @section('script')
        <script>
            var a = 0;
            $(window).scroll(function() {
                var oTop = $('.success').offset().top - window.innerHeight;
                if ( a ==0 && $(window).scrollTop() > oTop) {
                    $('.counter-value').each(function () {
                        $(this).prop('Counter',0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 5000,
                            easing: 'swing',
                            step: function (now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                    a = 1;
                }
            });
            $(function(){
                $('#myModal').modal({
                    show: false
                }).on('hidden.bs.modal', function(){
                    $(this).find('video')[0].pause();
                });
            });
        </script>
        <style>
        .blog .image img{
            min-height: 70%;
            max-width: 100%;
            /* height: 67%; */
            transition: all 0.6s ease-in-out;
        }
        </style>
    @endsection
@endsection

