@extends('FrontEnd.Layouts.Master')

@section('content')
    <?php
    $setting = \App\Setting::get()->keyBy('key')->all();
    ?>
    <main>
        <div class="inner-header">
            <div class="container">
                <h3 class="breadcrumb-title text-white bold">المدونة</h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('/Categories/'.$article->category_id.'/'.$article->category->slug)}}">{{$article->category->name_ar}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{\Illuminate\Support\Str::limit(strip_tags($article['name_'.Session::get('Lang')]),25)}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="blog single-blog page container p-t-50 p-b-50">
            <div class="row">
                <div class="col-lg-9 col-md-8 m-b-30">
                    <article class="m-b-20">
                        <!-- If Image -->
                        @if($article->file_type =='image')
                            <figure class=" m-t-20 m-b-20 text-center">
                                <img src="{{ asset('storage/app/articles/'.$article->id.'/' . $article->file) }}" alt="{{$article['name_'.Session::get('Lang')]}}">
                            </figure>
                        @elseif($article->file_type =='slider')

                        <!-- If Slider -->
                            <div class="owl-carousel owl-demo owl-theme m-t-20 m-b-20">
                                <?php
                                $photos = unserialize(base64_decode($article->photos));
                                ?>
                                @foreach ($photos as $photo)
                                    <?php
                                    $image_path = base_path() . '/storage/app/articles/' . $article->id . '/photos/' . $photo;
                                    ?>
                                    @if(File::exists($image_path))

                                        <div class="item">
                                            <img src="{{ asset('/storage/app/articles/' . $article->id . '/photos/' . $photo) }}"
                                                    alt="{{$article->name}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        @elseif($article->file_type =='youtube' || $article->file_type =='video_file' )

                        <!-- If Video -->

                            <div class="m-t-20 m-b-20 text-center">
                                @if($article->file_type =='youtube')
                                    <?php
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $article->link, $match);
                                    $youtube_id = $match[1];
                                    ?>
                                    <iframe src="https://www.youtube.com/embed/{{$youtube_id}}" frameborder="0"
                                            allow="autoplay; encrypted-media" allowfullscreen style="width:95%;margin:10px 0px;min-height:350px;">
                                    </iframe>
                                @endif
                                @if($article->file_type =='video_file')

                                    <video src="{{URL::to('storage/app/articles/'.$article->id.'/'.$article->file)}}"
                                            controls width="100%">
                                    </video>
                                @endif

                            </div>
                        @else
                        <!-- If 360 deg -->
                            <iframe src="{{$article->link}}"
                                    frameborder="0" marginheight="0" marginwidth="0"
                                    scrolling="no" framespacing="0" allowfullscreen></iframe>
                        @endif
                        <div class="content p-20">
                            <div class="m-b-20 d-flex align-items-center">
                                <div class="date float-right">
                                    <h2 class="secondary-color f-s-50 bold m-b-0">{{date('d',strtotime($article->publishDate))}}</h2>
                                    <span class="f-s-13 primary-color">{{date('M',strtotime($article->publishDate))}}</span>
                                </div>
                                <div class="info float-right">
                                    <a class="seacondary-color-hover">
                                        <h4 class="m-b-20">{{$article['name_'.Session::get('Lang')]}}</h4>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            {!! html_entity_decode($article['description_'.Session::get('Lang')]) !!}
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
                    </article>
                </div>
                <div class="col-lg-3 col-md-4 m-b-30 related">
                    <h4 class="related-title m-b-20">{{trans('Site.RelatedArticles')}}</h4>
                        @if(count($relatedArticles) != 0)
                            <div class="related archive p-10 m-t-40">
                                <h4 class="bg-primary-color text-white p-10 m-b-10">موضوعات متعلقة</h4>
                                @foreach($relatedArticles as $relatedArticle)
                                    <article>
                                        <figure class="m-b-0">
                                            <a href="{{url('/Categories/'.$relatedArticle->category_id.'/Articles/'.$relatedArticle->id.'/'.$relatedArticle->slug)}}">
                                                <img src="{{asset('/storage/app/articles/'.$relatedArticle->id.'/'.$relatedArticle->image)}}" alt="{{$relatedArticle['name_'.Session::get('Lang')]}}">
                                            </a>
                                        </figure>
                                        <div class="content p-15">
                                            <div class="info">
                                                <a href="{{url('/Categories/'.$relatedArticle->category_id.'/Articles/'.$relatedArticle->id.'/'.$relatedArticle->slug)}}" class="seacondary-color-hover">
                                                    <h5 class="m-b-20">{{$relatedArticle['name_'.Session::get('Lang')]}}</h5>
                                                </a>
                                                <p>
                                                {{\Illuminate\Support\Str::limit(strip_tags($relatedArticle['description_'.Session::get('Lang')]),280)}}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                </div>
            </div>
        </section>

    </main>

@endsection