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

    <section id="content">
         <div class="inner-header ">
            <div class="overlay">
                <div class="container">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('Site.BeSponsor')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
            <div class="page" style="margin-top:80px;">
                <div class="container">
                    <div class="row text-center justify-content-center m-t-30 attract2 ">
                        <div class="col-lg-3 col-sm-6 col-11 m-b-15">
                            <article class="m-b-30 wow zoomIn bg-white box-shadow" animation-delay="0.5s" data-wow-delay="0.2s">
                                <figure> <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/feat1.png" alt=""></figure>
                               <div  class="p-r-15 p-l-15 p-b-30" style="padding-top:45px;">
                                   <p>INCREASE brand awareness and place your brand firmly in front of your target audience</p>
                               </div>
                            </article>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-11 m-b-15">
                            <article class="m-b-30 wow zoomIn bg-white box-shadow" animation-delay="0.5s" data-wow-delay="0.2s">
                                <figure> <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/feat2.png" alt=""></figure>
                               <div  class="p-r-15 p-l-15 p-b-30" style="padding-top:45px;">
                                   <p>HIGHLIGHT your presence at the show and drive traffic to your stand</p>
                               </div>
                            </article>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-11 m-b-15">
                            <article class="m-b-30 wow zoomIn bg-white box-shadow" animation-delay="0.5s" data-wow-delay="0.2s">
                                <figure> <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/feat3.png" alt=""></figure>
                               <div  class="p-r-15 p-l-15 p-b-30" style="padding-top:45px;">
                                   <p>POSITION your company as a market leader over and above your competitors </p>
                               </div>
                            </article>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-11 m-b-15">
                            <article class="m-b-30 wow zoomIn bg-white box-shadow" animation-delay="0.5s" data-wow-delay="0.2s">
                                <figure> <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/feat4.png" alt=""></figure>
                               <div  class="p-r-15 p-l-15 p-b-30" style="padding-top:45px;">
                                   <p>INCREASE your global media exposure during and after the event</p>
                               </div>
                            </article>
                        </div>
                       
                    </div>
                    
                    <div class="row m-b-30" >
                        <div class="col-12">
                            <p> Maximize your presence and recognition at CAIRO LIFT-TECH SHOW.</p>
                            <p>Sponsoring CAIRO LIFT-TECH SHOW will make your company stand out as a leader in the Elevator & Escalator industries and will leave a strong impression of your brand in people’s minds.</p>
                           
                            <p>Your company will not only benefit from optimum exposure but will also get the opportunity to network with local, regional and international professionals from the industry.</p>
                            <p>For more details about CAIRO LIFT-TECH SHOW sponsorship opportunities, please contact us on info@intradamena.com </p>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>

    </section>



@endsection