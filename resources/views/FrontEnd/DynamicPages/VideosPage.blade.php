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
        <div class="inner-header">
            <div class="container">
                <h3 class="breadcrumb-title text-white bold">
                    {{trans('Site.Videos')}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Videos')}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="videos container p-t-50 p-b-50">
            <div class="row">
				@forelse($Videos as $Video)
					<?php 
						$string = str_replace('/', '-', $Video['VideoTitle_'.Session::get('Lang')]); // Replaces all spaces with hyphens.
						$linkVideoTitle = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
					?>
                    <div class="col-md-4 m-b-15">
                        <figure>
                            @if($Video->VideoPhoto != '')
                                <img src="{{ asset('storage/app/public/Videos/'.$Video->id.'/'.$Video->VideoPhoto) }}" alt="{{$Video['VideoTitle_'.Session::get('Lang')]}}">
                            @else
                                <img src="https://img.youtube.com/vi/{{ $Video->VideoCode }}/0.jpg" alt="{{$Video['VideoTitle_'.Session::get('Lang')]}}">
                            @endif
                            <figcaption>
                                <a href="#VideoModal{{$Video->id}}" class="text-white" data-toggle="modal">
                                    <i class="far fa-play-circle"></i>
                                </a>
                            </figcaption>
                        </figure>
                        <h5 class="video-title bg-secondary-color text-white p-20 text-center">{{$Video['VideoTitle_'.Session::get('Lang')]}}</h5>
                        <!-- Video Modal -->
                        <div class="modal fade login-modal bd-example-modal-lg" id="VideoModal{{$Video->id}}" tabindex="-1" role="dialog" aria-labelledby="VideoModal{{$Video->id}}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="myStopClickButton{{$Video->id}}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="video-modal">
                                            <iframe id="popup-youtube-player{{$Video->id}}" src="https://www.youtube.com/embed/{{ $Video->VideoCode }}?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" style="max-height:95% !important;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				@empty

				@endforelse
            </div>
            {{$Videos->links()}}
        </section>
    </main>
    @section('script')
        @foreach($Videos as $Video)
            <script>
                $('#myStopClickButton{{$Video->id}}').click(function(){
                    console.log('popup-youtube-player{{$Video->id}}');
                    $('#popup-youtube-player{{$Video->id}}')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*'); 
                });
            </script>
        @endforeach
    @endsection

@endsection