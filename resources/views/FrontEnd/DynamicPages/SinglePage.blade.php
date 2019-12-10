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
                    {{$page['name_'.Session::get('Lang')]}}
                </h3>
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page['name_'.Session::get('Lang')]}}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="page container p-t-50 p-b-50">
            @if($page->image !='')
                <div class="text-center">
                    <img src="{{ URL::to('storage/app/pages/'.$page->id.'/'.$page->image) }}" alt="{{$page['name_'.Session::get('Lang')]}}">
                </div>
            @endif
            {!! html_entity_decode($page['content_'.Session::get('Lang')]) !!}
        </section>
    </main>

@endsection