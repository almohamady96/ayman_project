@extends('SupervisorPanel.layouts.SupervisorIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/SupervisorPanel') }}">لوحة التحكم</a></li>
        <li class="active"> إعدادات الحساب  </li>
    </ol>

    {!! Form::open([ 'method'=>'post']) !!}
    <!-- Input -->

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        تعديل إعدادات الحساب
                        <small></small>
                    </h2>
                </div>
                <div class="body">

                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">الإسم </h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('userName')) error @endif">
                                    {{ Form::text('userName',$user->name,array('id'=>'userName','required'=>'true','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('userName'))
                                    <label id="userName-error" class="error"
                                           for="userName">{{ $errors->first('userName') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h2 class="card-inside-title">إسم المستخدم</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('uniqueName')) error @endif">
                                    {{ Form::text('uniqueName',$user->uniqueName,array('id'=>'uniqueName','required'=>'true','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('uniqueName'))
                                    <label id="uniqueName-error" class="error"
                                           for="uniqueName">{{ $errors->first('uniqueName') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h2 class="card-inside-title"> رقم الهاتف <span class="small"> ( يتكون من 10 أرقام علي الأقل ) </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('mobile')) error @endif">
                                    {{ Form::text('mobile',$user->mobile,array('id'=>'mobile','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('mobile'))
                                    <label id="mobile-error" class="error" for="mobile">{{ $errors->first('mobile') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title"> رقم الواتساب <span class="small"> ( إختياري .. 10 أرقام علي الأقل ) </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('whatsApp')) error @endif">
                                    {{ Form::text('whatsApp',$user->whatsApp,array('id'=>'whatsApp','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('whatsApp'))
                                    <label id="whatsApp-error" class="error" for="whatsApp">{{ $errors->first('whatsApp') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <h2 class="card-inside-title">البريد الإلكترونى</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('email')) error @endif">
                                    {{ Form::email('email',$user->email,array('id'=>'email','required'=>'true','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('email'))
                                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <h2 class="card-inside-title"> العنوان <span class="small"></span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('address')) error @endif">
                                    {{ Form::text('address',$user->address,array('id'=>'address','class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('address'))
                                    <label id="address-error" class="error" for="address">{{ $errors->first('address') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title"> كلمه المرور <span class="small"> ( 6 حروف أو أرقام علي الأقل ) </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('password')) error @endif">
                                    {{ Form::password('password',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('password'))
                                    <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <h2 class="card-inside-title"> تأكيد كلمه المرور <span class="small">  </span></h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('password_confirmation')) error @endif">
                                    {{ Form::password('password_confirmation',array('class'=>'form-control', 'placeholder'=>'')) }}
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <label id="password_confirmation-error" class="error" for="password_confirmation">{{ $errors->first('password_confirmation') }}</label>
                                @endif
                            </div>
                        </div>



                        <div class="col-sm-3" style="display: none">
                            <h2 class="card-inside-title"> الصلاحيات</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('role_id')) error @endif">

                                    {{ Form::select('role_id[]' ,$select_role,$user->roles()->pluck('role_id')->toArray(),array('id'=>'role_id','class'=>'form-control show-tick')) }}
                                </div>
                                @if ($errors->has('role_id'))
                                    <label id="role_id-error" class="error"
                                           for="role_id">{{ $errors->first('role_id') }}</label>
                                @endif
                            </div>

                        </div>

                        <div class="col-sm-3" style="display: none">
                            <h2 class="card-inside-title"> نوع العضويه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('account_type')) error @endif">

                                    {{ Form::select('account_type' ,[
                                                                    'user'=>'مستخدم',
                                                                    'seller'=>'بائع',
                                                                    ],$user->account_type,array('id'=>'account_type','class'=>'form-control show-tick'
                                                                                        )) }}
                                </div>
                                @if ($errors->has('account_type'))
                                    <label id="account_type-error" class="error"
                                           for="account_type">{{ $errors->first('account_type') }}</label>
                                @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        {{--<div class="col-sm-12">
                            <h2 class="card-inside-title">الصوره الشخصيه</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('avatar')) error @endif">
                                    <input id="file-photos" class="file" name="avatar" type="file" >
                                </div>
                                @if ($errors->has('avatar'))
                                    <label id="avatar-error" class="error"
                                           for="avatar">{{ $errors->first('avatar') }}</label>
                                @endif
                            </div>


                        </div>--}}

                        <div class="clearfix"></div>

                    </div>

                    <input type="submit" value="حفظ" class="btn bg-teal waves-effect" onclick="this.disabled=true; this.value='برجاء الإنتظار .. ';this.form.submit();">
                </div>
            </div>
        </div>
    </div>




    <!-- #END# Input -->

    {!! Form::close() !!}

@stop