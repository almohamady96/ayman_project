<?php
$setting = \App\Setting::get()->keyBy('key')->all();
if ($setting['logo']->value != '') {
    $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
} else {
    $logo_path = '/SiteAssets/style/images/logo.png';
}

?>


<footer class="sec-padding prime-bg text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 ">
              <div class="map">
                    @if($setting['map']->value != '')
                        {!!$setting['map']->value!!}
                    @endif
              </div>
            </div>
            <div class="col-md-3 ">
                <ul class="p-0 contact-info f-s-14">
                    <li>
                        <i class="fas fa-map-marker-alt primary-color m-l-5"></i>
                        @if($setting['address_'.Session::get('Lang')]->value !='')
                            {{$setting['address_'.Session::get('Lang')]->value}}
                        @endif
                    </li>
                    @if($setting['mobile']->value !='')
                        <li>
                            <a href="tel:{{$setting['mobile']->value }}">
                                <i class="fas fa-phone primary-color m-l-5"></i>
                                {{$setting['mobile']->value }}
                            </a>
                        </li>
                    @endif
                    @if($setting['mobile']->value !='')
                        <li>
                            <a href="https://api.whatsapp.com/send?phone={{$setting['mobile']->value }}">
                                <i class="fab fa-whatsapp primary-color m-l-5"></i>
                                {{$setting['mobile']->value }}
                            </a>
                        </li>
                    @endif
                    @if($setting['email']->value !='')
                        <li>
                            <a href="mailto:{{$setting['email']->value}}">
                                <i class="far fa-envelope primary-color m-l-5"></i>
                                {{$setting['email']->value}}
                            </a>
                        </li>
                    @endif
                    @if($setting['skype']->value !='')
                        <li>
                            <a href="skype:{{$setting['skype']->value}}?call">
                                <i class="fab fa-skype primary-color m-l-5"></i>
                                {{$setting['skype']->value}}
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="social p-0">
                    @if($setting['facebook']->value != '')
                        <li>
                            <a href="{{$setting['facebook']->value}}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['twitter']->value != '')
                        <li>
                            <a href="{{$setting['twitter']->value}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['youtube']->value != '')
                        <li>
                            <a href="{{$setting['youtube']->value}}" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['linkedin']->value != '')
                        <li>
                            <a href="{{$setting['linkedin']->value}}" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['google']->value != '')
                        <li>
                            <a href="{{$setting['google']->value}}" target="_blank">
                                <i class="fab fa-google-plus"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['instagram']->value != '')
                        <li>
                            <a href="{{$setting['instagram']->value}}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['rss']->value != '')
                        <li>
                            <a href="{{$setting['rss']->value}}" target="_blank">
                                <i class="fa fa-rss"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['pinterest']->value != '')
                        <li>
                            <a href="{{$setting['pinterest']->value}}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                    @endif
                    @if($setting['skype']->value != '')
                        <li>
                            <a href="{{$setting['skype']->value}}" target="_blank">
                                <i class="fab fa-skype"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            
            <div class="col-md-5">
                <h4 class="m-b-20">تواصل معنا</h4>
                {!! Form::open(['url'=>url('/contact')]) !!}
                    {!! csrf_field() !!}
                    <div class="form-row">
                        <div class="form-group col-6">
                            {{Form::text('userName','',array('required'=>'true','class'=>'form-control','id'=>'txt','placeholder'=>trans('Site.Name')))}}
                            @if ($errors->has('userName'))
                                <label class="warning m-t-10">
                                    <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                    <span>{{ $errors->first('userName') }}</span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            {{Form::email('email','',array('required'=>'true','class'=>'form-control','id'=>'email','placeholder'=>trans('Site.email')))}}
                            @if ($errors->has('email'))
                                <label class="warning m-t-10">
                                    <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                    <span>{{ $errors->first('email') }}</span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            {{Form::text('mobile','',array('required'=>'true','class'=>'form-control','id'=>'mobile','placeholder'=>trans('Site.Phone')))}}
                            @if ($errors->has('mobile'))
                                <label class="warning m-t-10">
                                    <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                    <span>{{ $errors->first('mobile') }}</span>
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::textarea('contactContent','',array('rows'=>3,'required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>'الاستفسارات/الاهتمامات'))}}
                        @if ($errors->has('contactContent'))
                            <label class="warning m-t-10">
                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                <span>{{ $errors->first('contactContent') }}</span>
                            </label>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="form-line @if($errors->has('contactContent')) error @endif">
                            معادلة التحقق البشرى
                            ناتج:
                            <?php
                                $T1 = rand(1, 9);
                                $T2 = rand(1, 9);
                                $T3 = $T1 + $T2;
                            ?>
                            {{$T1}} + {{$T2}} =
                            {{Form::text('recaptcha','',array('required'=>'true','class'=>'form-control','id'=>'comment','placeholder'=>'اكتب الناتج هنا'))}}
                            <input name="T3" type="hidden" value="{{$T3}}" />
                        </div>
                        @if ($errors->has('contactContent'))
                            <label class="warning m-t-0">
                                <i class="fa fa-warning m-{{trans('site.marginDir')}}-5"></i>
                                <span>{{ $errors->first('contactContent') }}</span>
                            </label>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <button type="submit" class="btn gradient-top w-100">ارسال</button>
                {!! Form::close() !!}
            </div>
        </div>

        <hr/>

        <div class="copyright d-flex justify-content-between">
            <p>جميع الحقوق محفوظه لشركة <a href="{{url('')}}" target="_blank">{{$setting['title']->value}}</a> &copy; 2018</p>
            <p>تصميم وبرمجة <a href="http://www.sato4u.com" target="_blank">شركة ساتو لتطوير الأعمال</a></p>
        </div>
    </div>
</footer>
