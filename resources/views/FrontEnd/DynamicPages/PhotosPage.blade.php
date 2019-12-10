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
    <section>
        <!-- services -->
        <section class="container sec-padding">
            <div class="row no-margin">
                <div class="col-sm-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Gallery')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="masonry m-b-50">
                @forelse($Photos as $image)
                    <div class="item">
                        <a href="{{URL::to('storage/app/gallery/' . $image->id . '/' . $image->file)}}" data-lightbox="roadtrip" data-title="{{$image->name}}">
                            <img src="{{URL::to('storage/app/gallery/' . $image->id . '/' . $image->file)}}">
                        </a>
                    </div>
                @empty
                    
                @endforelse
            </div>
            {{$Photos->links()}}
        </section>
    </section>

@endsection