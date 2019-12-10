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
                    {{trans('Site.Consultancies')}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{trans('Site.Consultancies')}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="consultance container p-t-50 p-b-50">
            <div class="row">
                @forelse($Photos as $image)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="company m-b-30 text-center">
                            <figure>
                                <img src="{{URL::to('storage/app/partners/' . $image->id . '/' . $image->file)}}" alt="">
                            </figure>
                            <h5>{{$image->name}}</h5>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            {{$Photos->links()}}
        </section>
    </main>

@endsection