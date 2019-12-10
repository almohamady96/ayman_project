<?php
$setting = \App\Setting::get()->keyBy('key')->all();
if ($setting['logo']->value != '') {
    $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
} else {
    $logo_path = '/SiteAssets/style/images/logo.png';
}

?>

<div class="col-2 d-none d-lg-block d-md-block d-sm-block banner left-banners text-left p-0">
    <div class="side-banner1">
        <?php
        $topLeftAd = \App\Ad::where('status', '=', 'active')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('type', '=', 'top_left')
            ->orderByRaw('RAND()')
            ->first();
        ?>
        @if($topLeftAd != '')
            @if($topLeftAd -> code != '')
                {!! html_entity_decode($topLeftAd->code) !!}
            @else
                <a href="{{url('/VisitAd/'.$topLeftAd->id)}}" target="_blank">
                    <img src="{{asset('/storage/app/ads/'.$topLeftAd->id.'/'.$topLeftAd->image)}}"
                         alt="{{$topLeftAd->name}}">
                    <!-- 130*600 -->
                </a>
            @endif
        @else
            <a href="#" target="_blank">
                <img src="{{URL::to('/')}}/SiteAssets/style/images/side-banner1.png" alt="{{$setting['title']->value}}">
                <!-- 130*600 -->
            </a>
        @endif
    </div>

    <div class="side-banner2">
        <?php
        $bottomLeftAd = \App\Ad::where('status', '=', 'active')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('type', '=', 'bottom_left')
            ->orderByRaw('RAND()')
            ->first();
        ?>
        @if($bottomLeftAd != '')
            @if($bottomLeftAd -> code != '')
                {!! html_entity_decode($bottomLeftAd->code) !!}
            @else
                <a href="{{url('/VisitAd/'.$bottomLeftAd->id)}}" target="_blank">
                    <img src="{{asset('/storage/app/ads/'.$bottomLeftAd->id.'/'.$bottomLeftAd->image)}}"
                         alt="{{$bottomLeftAd->name}}">
                    <!-- 130*600 -->
                </a>
            @endif
        @else
            <a href="#" target="_blank">
                <img src="{{URL::to('/')}}/SiteAssets/style/images/side-banner1.png" alt="{{$setting['title']->value}}">
                <!-- 130*600 -->
            </a>
        @endif
    </div>
</div>
