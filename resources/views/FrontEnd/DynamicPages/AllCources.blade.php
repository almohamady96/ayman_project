@extends('FrontEnd.Layouts.Master')
<?php
$Setting = \App\Setting::get()->keyBy('key')->all();

?>
@section('content')

    <section>
        <!-- services -->
            <section class="services sec-padding">
                <div class="container">
                    <div class="text-center m-b-20">
                        <h2 class="header-title">الدورات التدريبية</h2>
                    </div>
                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="true" aria-expanded="true">جميع الدورات</a>
                        </li>
                        <?php
                            $ServicesSections = App\ServicesSections::orderBy('Ordered','asc')->get();
                            $FirstServices = App\Services::orderBy('id','desc')->get();
                        ?>
                        @foreach($ServicesSections as $Section)
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tab{{$Section->id}}-tab" data-toggle="pill" href="#pills-tab{{$Section->id}}" role="tab" aria-controls="pills-tab{{$Section->id}}" aria-selected="false" aria-expanded="false">
                                    {{$Section['Title_'.Session::get('Lang')]}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content p-t-20" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab" aria-expanded="true">
                            <div class="row justify-content-center no-margin">
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
                                        $SectionServices = App\Services::where('SectionID',$Section->id)->orderBy('id','desc')->get();
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
                </div>
                
            </section>
        <!-- #END# services -->
    </section>

@endsection

