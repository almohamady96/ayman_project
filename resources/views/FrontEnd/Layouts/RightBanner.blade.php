<?php
$setting = \App\Setting::get()->keyBy('key')->all();
if ($setting['logo']->value != '') {
    $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
} else {
    $logo_path = '/SiteAssets/style/images/logo.png';
}

?>

<div class="col-sm-2 col-3 banner right-banners text-right p-0">
    <div class="side-banner1">
        <?php
        $topRightAd = \App\Ad::where('status', '=', 'active')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('type', '=', 'top_right')
            ->orderByRaw('RAND()')
            ->first();
        ?>
        @if($topRightAd != '')
            @if($topRightAd -> code != '')
                {!! html_entity_decode($topRightAd->code) !!}
            @else
                <a href="{{url('/VisitAd/'.$topRightAd->id)}}" target="_blank">
                    <img src="{{asset('/storage/app/ads/'.$topRightAd->id.'/'.$topRightAd->image)}}"
                         alt="{{$topRightAd->name}}">
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
        $bottomRightAd = \App\Ad::where('status', '=', 'active')
            ->where('publishTime', '<=', strtotime('now'))
            ->where('expireTime', '>=', strtotime('now'))
            ->where('type', '=', 'bottom_right')
            ->orderByRaw('RAND()')
            ->first();
        ?>
        @if($bottomRightAd != '')
            @if($bottomRightAd -> code != '')
                {!! html_entity_decode($bottomRightAd->code) !!}
            @else
                <a href="{{url('/VisitAd/'.$bottomRightAd->id)}}" target="_blank">
                    <img src="{{asset('/storage/app/ads/'.$bottomRightAd->id.'/'.$bottomRightAd->image)}}"
                         alt="{{$bottomRightAd->name}}">
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
