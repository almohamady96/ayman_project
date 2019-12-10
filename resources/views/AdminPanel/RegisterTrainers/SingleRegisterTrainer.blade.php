@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li><a href="{{ URL::to('/AdminPanel/PersonalTrainings') }}">إدراه نماذج الإشتراك بالتدريب الفردى</a></li>
        <li class="active">{{$PageTitle}}</li>
    </ol>

    {{-- {!! Form::open(['files'=>true,'url'=>'/AdminPanel/Emails/CreateEmail' ,'method'=>'post']) !!}
    --}}
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$PageTitle}}
                        <small></small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                    <div class="col-sm-4">
                            <h2 class="card-inside-title">الإسم</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{$form->PersonName}}</p>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">اسم الشركة</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                  <p>{{$form->CompanyName}}</p>
                                </div>
                            </div>
                        </div>
                        --}}
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">المدينة</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                <p>{{$form->Address}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">الهاتف</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{$form->Phone}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">واتس اب</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                <p>{{$form->Mobile}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">البريد الإلكتروني</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                  <p>{{$form->Email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">المؤهل</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{$form->Title}}</p>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="col-sm-4">
                            <h2 class="card-inside-title">العنوان</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                <p>{{$form->Address}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">Security</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                  <p>{{$form->Security}}</p>
                                </div>
                            </div>
                        </div>
                        --}}
                        <div class="col-sm-3">
                            <h2 class="card-inside-title">التاريخ</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p>{{date('d-m-Y',strtotime($form->created_at))}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">محتوي الرساله</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <p style="margin-top: 15px;margin-bottom: 15px">{!! html_entity_decode($form->msg) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h2 class="card-inside-title">المرفقات</h2>
                            <div class="form-group">
                                <div class="form-line @if($errors->has('')) error @endif">
                                    <a class="btn btn-md btn-info" href="{{URL::to('storage/app/aplications/' . $form->id . '/' . $form->file)}}">اضغط هنا لإستعراض الملف</a>
                                </div>
                            </div>
                        </div>



                        {{--<div class="clearfix"></div>
--}}

                    </div>
                    {{-- {{ Form::submit('إرسال',array('class'=>'btn bg-teal waves-effect')) }}
               --}}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop