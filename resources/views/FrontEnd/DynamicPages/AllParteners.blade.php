@extends('FrontEnd.Layouts.Master')
<?php
$Setting = \App\Setting::get()->keyBy('key')->all();

?>
@section('content')

    <section class="sec-padding">
        @if(count($Gallery) > 0)
        <!-- partners -->
            <section class="partners container m-t-40 m-b-40 text-center">
                <div class="text-center m-b-20 wow zoomIn" animation-delay="1s" data-wow-delay="0.4s">
                    <h2 class="bold header-title">
                        @if($Type == 'TeamMember')
                            الخبراء
                        @elseif($Type == 'Center')
                            مراكز صديقة
                        @elseif($Type == 'Certificate')
                            الإعتمادات
                        @else
                            شركاء النجاح
                        @endif
                    </h2>
                </div>
                <div class="owl-demo partners-owl-demo">
                    @foreach($Gallery as $Photo)
                        <div class="item">
                            @if($Type != 'TeamMember')
                                <a href="{{$Photo->name}}" target="_blank">
                            @endif
                                <img src="{{URL::to('storage/app/'.$Type.'s/' . $Photo->id . '/' . $Photo->file)}}" alt="Owl Image">
                                @if($Type == 'TeamMember')
                                    <h3>{{$Photo->name}}</h3>
                                    <p>{{$Photo->des}}</p>
                                @endif
                            @if($Type != 'TeamMember')
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        <!-- #END# partners -->
        @endif
    </section>

@endsection

