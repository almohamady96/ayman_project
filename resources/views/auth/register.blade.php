@extends('FrontEnd.Layouts.Master')
@section('content')
    <?php
    $setting = \App\Setting::get()->keyBy('key')->all();

    if ($setting['logo']->value != '') {
        $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
    } else {
        $logo_path = '/SiteAssets/style/images/logo.png';
    }

    if ($setting['fav']->value != '') {
        $fav_path = '/storage/app/Settings/' . $setting['fav']->value;
    } else {
        $fav_path = '/SiteAssets/style/images/logo.png';
    }


    ?>

    <main>
        <div class="row justify-content-center register m-0 p-t-50 p-b-50">
            <div class="col-lg-6 col-md-10">
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="text-center m-b-40">
                        <h4 class="primary-color m-t-15 text-center">نتشرف بانضمامك الينا</h4>
                        <span class="text-muted f-s-13">قم بملأ البيانات التالية لاتمام عملية التسجيل</span>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                               placeholder="الإسم" required>

                        @if ($errors->has('name'))
                            <span class="text-danger f-s-14">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required placeholder="البريد الإلكتروني">

                        @if ($errors->has('email'))
                            <span class="text-danger f-s-14">
                                        {{ $errors->first('email') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required
                               placeholder="كلمه المرور">

                        @if ($errors->has('password'))
                            <span class="text-danger f-s-14">
                                        {{ $errors->first('password') }}
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required placeholder="تأكيد كلمه المرور">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn news-btn m-t-20">تسجيل</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
