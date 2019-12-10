@extends('FrontEnd.Layouts.Master')

@section('content')
    <?php
    $setting = \App\Setting::get()->keyBy('key')->all();
    ?>
    <main>
        <div class="inner-header">
            <div class="container">
                <h3 class="breadcrumb-title text-white bold">
                    {{trans('Site.Blog')}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Blog')}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="blog container p-t-50 p-b-50">
            <div class="row">
                @foreach($articles as $article)
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
                @if(count($articles) == 0)
                    <p>لا يوجد مقالات</p>
                @endif
            </div>
            @include('pagination.default', ['paginator' => $articles])
        </section>
    </main>
@endsection