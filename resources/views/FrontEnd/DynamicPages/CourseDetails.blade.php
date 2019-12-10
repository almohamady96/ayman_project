@extends('FrontEnd.Layouts.Master')
<?php
$Setting = \App\Setting::get()->keyBy('key')->all();

?>
@section('content')

    <section class="container sec-padding">
        <div class="row no-margin">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">{{trans('Site.SiteHomePage')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('/Cources/الدورات-التدريبية')}}">الدورات التدريبية</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$seo_title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- services -->
            <section>
                <div class="text-center">
                    @if($Course->photos != '')
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php $Userialiezed = unserialize($Course->photos); $X = 0; ?>
                                @foreach ($Userialiezed as $value)
                                    <?php
                                        $PhotoPath = base_path().'/storage/app/public/Services/'.$Course->id.'/photos/'.$value;
                                        if(File::exists($PhotoPath)){
                                    ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$X}}" @if($X == 0) class="active" @endif></li>
                                    <?php
                                        $X++;
                                        }
                                    ?>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                <?php $Y = 0; ?>
                                @foreach ($Userialiezed as $value)
                                    <?php
                                        $PhotoPath = base_path().'/storage/app/public/Services/'.$Course->id.'/photos/'.$value;
                                        if(File::exists($PhotoPath)){
                                    ?>
                                        <div class="carousel-item @if($Y == 0) active @endif ">
                                            <img class="d-block w-100" src="{{ asset('storage/app/public/Services/'.$Course->id.'/photos/'.$value) }}">
                                        </div>
                                    <?php
                                        $Y++;
                                        }
                                    ?>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        @if($Course->photo != '')
                            <img src="{{ asset('storage/app/public/Services/'.$Course->id.'/'.$Course->photo) }}" alt="{{$Course['Title_'.Session::get('Lang')]}}" style="max-width: 100%;">
                        @else
                            <img src="{{URL::to('/')}}/SiteAssets/Technomasr/images/no-image.png" alt="{{$Course['Title_'.Session::get('Lang')]}}">
                        @endif
                    @endif
                </div>
                <div class="row no-margin">
                    <div class="col-sm-12">
                        {!!$Course['details_'.Session::get('Lang')]!!}
                    </div>
                    <div class="col-sm-12 p-t-15">
                        <div id="accordion">
                            @if($Course->Hours != '' || $Course->Days != '')
                                <div class="card">
                                    <div class="card-header" id="headingHours">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseHours" aria-expanded="true" aria-controls="collapseHours">
                                                المدة الزمنية
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseHours" class="collapse show" aria-labelledby="headingHours" data-parent="#accordion">
                                        <div class="card-body">
                                            <ul>
                                                @if($Course->Hours != '')
                                                    <li>
                                                        عدد الساعات: {{$Course->Hours}}
                                                    </li>
                                                @endif
                                                @if($Course->Days != '')
                                                    <li>
                                                        عدد الأيام: {{$Course->Days}}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($Course['tab1_'.Session::get('Lang')] != '')
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                الهدف العام
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            {!!$Course['tab1_'.Session::get('Lang')]!!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($Course['tab2_'.Session::get('Lang')] != '')
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                الأهداف التفصيلية
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            {!!$Course['tab2_'.Session::get('Lang')]!!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($Course['tab3_'.Session::get('Lang')] != '')
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                محاور التدريب
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            {!!$Course['tab3_'.Session::get('Lang')]!!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($Course['tab4_'.Session::get('Lang')] != '')
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                أساليب وسائل التدريب
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                        <div class="card-body">
                                            {!!$Course['tab4_'.Session::get('Lang')]!!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($Course['tab5_'.Session::get('Lang')] != '')
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                الفئة المستهدفة
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                        <div class="card-body">
                                            {!!$Course['tab5_'.Session::get('Lang')]!!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row no-margin m-t-20">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    للإشتراك املأ البيانات التالية
                                </h5>
                            </div>
                            {{Form::open()}}
                                @if(Session::get('Success') != '')
                                    <div class="row p-15">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success" role="alert">
                                                {{Session::get('Success')}}
                                                {{Session::forget('Success')}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row p-15">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">نوع التسجيل</label>
                                            <select name="CompanyName" class="form-control" id="exampleFormControlSelect1" style="padding: .2rem .75rem;">
                                                <option value="Person">فردى</option>
                                                <option value="Company">شركة</option>
                                            </select>
                                            @if ($errors->has('CompanyName'))
                                                <label id="CompanyName-error" class="error" for="CompanyName">{{ $errors->first('CompanyName') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">الإسم</label>
                                            <input name="PersonName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="اكتب الاسم ثلاثي" reqiured>
                                            @if ($errors->has('PersonName'))
                                                <label id="PersonName-error" class="error" for="PersonName">{{ $errors->first('PersonName') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">الهاتف</label>
                                            <input name="Phone" type="text" class="form-control" id="exampleFormControlInput1" placeholder="رقم هاتف ثابت او جوال" reqiured>
                                            @if ($errors->has('Phone'))
                                                <label id="Phone-error" class="error" for="Phone">{{ $errors->first('Phone') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">المدينة</label>
                                            <input name="Address" type="text" class="form-control" id="exampleFormControlInput1" reqiured>
                                            @if ($errors->has('Address'))
                                                <label id="Address-error" class="error" for="Address">{{ $errors->first('Address') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">واتس اب</label>
                                            <input name="Mobile" type="text" class="form-control" id="exampleFormControlInput1" placeholder="رقم واتس اب الخاص بك">
                                            @if ($errors->has('Mobile'))
                                                <label id="Mobile-error" class="error" for="Mobile">{{ $errors->first('Mobile') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">البريد الإلكترونى</label>
                                            <input name="Email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="اكتب بريد إلكترونى صالحمثال: name@example.com">
                                            @if ($errors->has('Email'))
                                                <label id="Email-error" class="error" for="Email">{{ $errors->first('Email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">المؤهل</label>
                                            <input name="Title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="اخر شهادة مؤهل حصلت عليها">
                                            @if ($errors->has('Title'))
                                                <label id="Title-error" class="error" for="Title">{{ $errors->first('Title') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">رسالة توضيحية</label>
                                            <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            @if ($errors->has('msg'))
                                                <label id="msg-error" class="error" for="msg">{{ $errors->first('msg') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary">اشترك الآن</button>
                                    </div>
                                    {{Form::hidden('CourseID',$Course->Title_ar)}}
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </section>
        <!-- #END# services -->
    </section>
<style>
    #accordion .card {
        margin: 5px;
        border: 1px solid rgb(0, 46, 86);
    }
    #accordion .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgb(0, 46, 86);
        border-bottom: 1px solid rgb(0, 46, 86);
    }
    #accordion .btn-link {
        color:#fff;
    }
</style>
@endsection

