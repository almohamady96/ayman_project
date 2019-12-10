@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <ol class="breadcrumb breadcrumb-bg-teal">
        <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
        <li class="active">إعدادات الموقع</li>
    </ol>

    {!! Form::open(['files'=>true]) !!}

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        إعدادات الموقع
                        <small>تستطيع التحكم فى كافة الإعدادات الخاصة بالموقع من هنا.</small>
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"> الإعدادات
                                العامه</a></li>
                        <li role="presentation" class=""><a href="#tab2" data-toggle="tab">الإعدادات الرئيسيه</a></li>
                        <li role="presentation"><a href="#tab3" data-toggle="tab">بيانات الإتصال</a></li>
                        <li role="presentation"><a href="#tab4" data-toggle="tab">بيانات التواصل الإجتماعي</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!---------------------------------------->

                        <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                            <br>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">حاله الموقع</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('status')) error @endif">
                                        {{ Form::select('status',[
                                                                                'open'=>'مفتوح',
                                                                                'close'=>'مغلق',
                                                                            ],$setting['status']->value,array('id'=>'status','class'=>'form-control show-tick')) }}
                                    </div>
                                    @if ($errors->has('status'))
                                        <label id="status-error" class="error"
                                               for="status">{{ $errors->first('status') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <h2 class="card-inside-title">رساله الإغلاق </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('status_msg')) error @endif">
                                        {{ Form::text('status_msg',$setting['status_msg']->value,array('id'=>'status_msg','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('status_msg'))
                                        <label id="status_msg-error" class="error"
                                               for="status_msg">{{ $errors->first('status_msg') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">إعدادات تلقي الإشعارات</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('notification_status')) error @endif">
                                        {{ Form::select('notification_status',[
                                                                                'site'=>'إشعارات للموقع فقط',
                                                                                'both'=>'إشعارات للموقع والبريد الإليكتروني',
                                                                                ],$setting['notification_status']->value,array('id'=>'notification_status','class'=>'form-control show-tick')) }}
                                    </div>
                                    @if ($errors->has('notification_status'))
                                        <label id="notification_status-error" class="error"
                                               for="notification_status">{{ $errors->first('notification_status') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">البريد الإلكترونى لتلقي إشعارات الموقع</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('notification_email')) error @endif">
                                        {{ Form::email('notification_email',$setting['notification_email']->value,array('id'=>'notification_email','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('notification_email'))
                                        <label id="notification_email-error" class="error"
                                               for="notification_email">{{ $errors->first('notification_email') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">البريد الإلكترونى لإرسال رسائل للأعضاء</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('messages_email')) error @endif">
                                        {{ Form::email('messages_email',$setting['messages_email']->value,array('id'=>'messages_email','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('messages_email'))
                                        <label id="messages_email-error" class="error"
                                               for="messages_email">{{ $errors->first('messages_email') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="clearfix"></div>


                        </div>

                        <!------------------------------------->

                        <div role="tabpanel" class="tab-pane fade " id="tab2">
                            <br>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">اسم الموقع </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('title')) error @endif">
                                        {{ Form::text('title',$setting['title']->value,array('id'=>'title','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('title'))
                                        <label id="title-error" class="error"
                                               for="title">{{ $errors->first('title') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">حقوق الملكيه بالعربية </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('copyrights_ar')) error @endif">
                                        {{ Form::text('copyrights_ar',isset($setting['copyrights_ar']->value) ? $setting['copyrights_ar']->value : '',array('id'=>'copyrights_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('copyrights_ar'))
                                        <label id="copyrights_ar-error" class="error"
                                               for="copyrights_ar">{{ $errors->first('copyrights_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">حقوق الملكيه بالإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('copyrights_en')) error @endif">
                                        {{ Form::text('copyrights_en',isset($setting['copyrights_en']->value) ? $setting['copyrights_en']->value : '',array('id'=>'copyrights_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('copyrights_en'))
                                        <label id="copyrights_en-error" class="error"
                                               for="copyrights_en">{{ $errors->first('copyrights_en') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-sm-6">
                                <h2 class="card-inside-title">وصف الموقع </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('description')) error @endif">
                                        {{ Form::textarea('description',$setting['description']->value,array('rows'=>3,'id'=>'description','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('description'))
                                        <label id="description-error" class="error"
                                               for="description">{{ $errors->first('description') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h2 class="card-inside-title">الكلمات الدليلية </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('keywords')) error @endif">
                                        {{ Form::textarea('keywords',$setting['keywords']->value,array('rows'=>3,'id'=>'keywords','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('keywords'))
                                        <label id="keywords-error" class="error"
                                               for="keywords">{{ $errors->first('keywords') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <div class="col-sm-3" style="">
                                <h2 class="card-inside-title">لوجو الموقع </h2>
                                <?php $x = 1; ?>

                                @if($setting['logo']->value != '')
                                    <div class="col-sm-12" id="row_{{ $x }}">
                                        <a href="{{URL::to('storage/app/Settings/'.$setting['logo']->value)}}"
                                           target="_blank">
                                            <img src="{{ URL::to('storage/app/Settings/'.$setting['logo']->value) }}"
                                                 alt=""
                                                 style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                        </a>
                                        <div class="clearfix"></div>
                                        <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/logo/'.$setting['logo']->value.'/'.$x.'/Delete') }}')"
                                              class="btn btn-danger btn-sm btn-block"
                                              style="margin: 10px; width: 50%">حذف الصورة</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $x++; ?>

                                @endif
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('logo')) error @endif">
                                        <input id="file-photos" class="file" name="logo" type="file">
                                    </div>
                                    @if ($errors->has('logo'))
                                        <label id="logo-error" class="error"
                                               for="logo">{{ $errors->first('logo') }}</label>
                                    @endif
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <h2 class="card-inside-title">الصورة البديلة</h2>
                                @if($setting['fav']->value != '')
                                    <div class="col-sm-12" id="row_{{ $x }}">
                                        <a href="{{URL::to('storage/app/Settings/'.$setting['fav']->value)}}"
                                           target="_blank">
                                            <img src="{{ URL::to('storage/app/Settings/'.$setting['fav']->value) }}"
                                                 alt=""
                                                 style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                        </a>
                                        <div class="clearfix"></div>
                                        <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/fav/'.$setting['fav']->value.'/'.$x.'/Delete') }}')"
                                              class="btn btn-danger btn-sm btn-block"
                                              style="margin: 10px; width: 50%">حذف الصورة</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $x++; ?>
                                @endif
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('fav')) error @endif">
                                        <input id="file-photos" class="file" name="fav" type="file">
                                    </div>
                                    @if ($errors->has('fav'))
                                        <label id="fav-error" class="error"
                                               for="fav">{{ $errors->first('fav') }}</label>
                                    @endif
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <h2 class="card-inside-title">صورة المشاركة الإجتماعية العامة</h2>
                                @if($setting['socialPhoto']->value != '')
                                    <div class="col-sm-12" id="row_{{ $x }}">
                                        <a href="{{URL::to('storage/app/Settings/'.$setting['socialPhoto']->value)}}"
                                           target="_blank">
                                            <img src="{{ URL::to('storage/app/Settings/'.$setting['socialPhoto']->value) }}"
                                                 alt=""
                                                 style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                        </a>
                                        <div class="clearfix"></div>
                                        <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/socialPhoto/'.$setting['socialPhoto']->value.'/'.$x.'/Delete') }}')"
                                              class="btn btn-danger btn-sm btn-block"
                                              style="margin: 10px; width: 50%">حذف الصورة</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $x++; ?>
                                @endif
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('socialPhoto')) error @endif">
                                        <input id="file-photos" class="file" name="socialPhoto" type="file">
                                    </div>
                                    @if ($errors->has('socialPhoto'))
                                        <label id="socialPhoto-error" class="error"
                                               for="socialPhoto">{{ $errors->first('socialPhoto') }}</label>
                                    @endif
                                </div>

                            </div>


                            <div class="col-sm-3">
                                <h2 class="card-inside-title">صورة الفوتر</h2>
                                @if($setting['footer_image']->value != '')
                                    <div class="col-sm-12" id="row_{{ $x }}">
                                        <a href="{{URL::to('storage/app/Settings/'.$setting['footer_image']->value)}}"
                                           target="_blank">
                                            <img src="{{ URL::to('storage/app/Settings/'.$setting['footer_image']->value) }}"
                                                 alt=""
                                                 style="max-height:200px;width:auto;max-width:100%; margin:5px auto;">
                                        </a>
                                        <div class="clearfix"></div>
                                        <span onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Image/footer_image/'.$setting['footer_image']->value.'/'.$x.'/Delete') }}')"
                                              class="btn btn-danger btn-sm btn-block"
                                              style="margin: 10px; width: 50%">حذف الصورة</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $x++; ?>
                                @endif
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('footer_image')) error @endif">
                                        <input id="file-photos" class="file" name="footer_image" type="file">
                                    </div>
                                    @if ($errors->has('footer_image'))
                                        <label id="footer_image-error" class="error"
                                               for="footer_image">{{ $errors->first('footer_image') }}</label>
                                    @endif
                                </div>

                            </div>


                            <div class="clearfix"></div>

                        </div>

                        <!---------------------------------------->

                        <div role="tabpanel" class="tab-pane fade" id="tab3">
                            <br>

                            <div class="col-sm-6">
                                <h2 class="card-inside-title">العنوان باللغة العربية </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('address_ar')) error @endif">
                                        {{ Form::textarea('address_ar',isset($setting['address_ar']->value) ? $setting['address_ar']->value : '',array('rows'=>1,'id'=>'address_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('address_ar'))
                                        <label id="address_ar-error" class="error"
                                               for="address_ar">{{ $errors->first('address_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">العنوان باللغة الإنجليزية </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('address_en')) error @endif">
                                        {{ Form::textarea('address_en',isset($setting['address_en']->value) ? $setting['address_en']->value : '',array('rows'=>1,'id'=>'address_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('address_en'))
                                        <label id="address_en-error" class="error"
                                               for="address_en">{{ $errors->first('address_en') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">البريد الإلكترونى</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('email')) error @endif">
                                        {{ Form::email('email',$setting['email']->value,array('id'=>'email','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('email'))
                                        <label id="email-error" class="error"
                                               for="email">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">رقم الموبايل </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('mobile')) error @endif">
                                        {{ Form::text('mobile',$setting['mobile']->value,array('id'=>'mobile','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <label id="mobile-error" class="error"
                                               for="mobile">{{ $errors->first('mobile') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">الهاتف الأرضي</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('phone')) error @endif">
                                        {{ Form::text('phone',$setting['phone']->value,array('id'=>'phone','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('phone'))
                                        <label id="Phone-error" class="error"
                                               for="Phone">{{ $errors->first('phone') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">أيام العمل باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('WorkingDays_ar')) error @endif">
                                        {{ Form::text('WorkingDays_ar',isset($setting['WorkingDays_ar']->value) ? $setting['WorkingDays_ar']->value : '',array('id'=>'WorkingDays_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('WorkingDays_ar'))
                                        <label id="WorkingDays_ar-error" class="error"
                                               for="WorkingDays_ar">{{ $errors->first('WorkingDays_ar') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h2 class="card-inside-title">أيام العمل باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('WorkingDays_en')) error @endif">
                                        {{ Form::text('WorkingDays_en',isset($setting['WorkingDays_en']->value) ? $setting['WorkingDays_en']->value : '',array('id'=>'WorkingDays_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('WorkingDays_en'))
                                        <label id="WorkingDays_en-error" class="error"
                                               for="WorkingDays_en">{{ $errors->first('WorkingDays_en') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h2 class="card-inside-title">مواعيد العمل باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('WorkingHours_ar')) error @endif">
                                        {{ Form::text('WorkingHours_ar',isset($setting['WorkingHours_ar']->value) ? $setting['WorkingHours_ar']->value : '',array('id'=>'WorkingHours_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('WorkingHours_ar'))
                                        <label id="WorkingHours_ar-error" class="error"
                                               for="WorkingHours_ar">{{ $errors->first('WorkingHours_ar') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h2 class="card-inside-title">مواعيد العمل باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('WorkingHours_en')) error @endif">
                                        {{ Form::text('WorkingHours_en',isset($setting['WorkingHours_en']->value) ? $setting['WorkingHours_en']->value : '',array('id'=>'WorkingHours_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('WorkingHours_en'))
                                        <label id="WorkingHours_en-error" class="error"
                                               for="WorkingHours_en">{{ $errors->first('WorkingHours_en') }}</label>
                                    @endif
                                </div>
                            </div>

                            {{--
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">الخط الساخن</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('hotLine')) error @endif">
                                        {{ Form::text('hotLine',$setting['hotLine']->value,array('id'=>'hotLine','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('hotLine'))
                                        <label id="hotLine-error" class="error"
                                               for="hotLine">{{ $errors->first('hotLine') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">رقم الشكاوي والمقترحات</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('supportLine')) error @endif">
                                        {{ Form::text('supportLine',$setting['supportLine']->value,array('id'=>'supportLine','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('supportLine'))
                                        <label id="supportLine-error" class="error"
                                               for="supportLine">{{ $errors->first('supportLine') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title">الفاكس </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('fax')) error @endif">
                                        {{ Form::text('fax',$setting['fax']->value,array('id'=>'fax','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('fax'))
                                        <label id="fax-error" class="error"
                                               for="fax">{{ $errors->first('fax') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h2 class="card-inside-title">واتس اب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('whatsApp')) error @endif">
                                        {{ Form::text('whatsApp',$setting['whatsApp']->value,array('id'=>'whatsApp','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('whatsApp'))
                                        <label id="whatsApp-error" class="error"
                                               for="whatsApp">{{ $errors->first('whatsApp') }}</label>
                                    @endif
                                </div>
                            </div>
                            --}}


                            <div class="col-sm-12">
                                <h2 class="card-inside-title"> خريطة جوجل</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('map')) error @endif">
                                        {{ Form::textarea('map',$setting['map']->value,array('rows'=>5,'id'=>'map','class'=>'form-control')) }}
                                    </div>
                                    @if ($errors->has('map'))
                                        <label id="map-error" class="error"
                                               for="map">{{ $errors->first('map') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!---------------------------------------->

                        <div role="tabpanel" class="tab-pane fade" id="tab4">
                            <br>
                            <div class="row">

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">فيس بوك</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('facebook')) error @endif">
                                            {{ Form::text('facebook',$setting['facebook']->value,array('id'=>'facebook','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('facebook'))
                                            <label id="facebook-error" class="error"
                                                   for="facebook">{{ $errors->first('facebook') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">تويتر</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('twitter')) error @endif">
                                            {{ Form::text('twitter',$setting['twitter']->value,array('id'=>'twitter','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('twitter'))
                                            <label id="twitter-error" class="error"
                                                   for="twitter">{{ $errors->first('twitter') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">سكايب</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('skype')) error @endif">
                                            {{ Form::text('skype',$setting['skype']->value,array('id'=>'skype','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('skype'))
                                            <label id="skype-error" class="error"
                                                   for="skype">{{ $errors->first('skype') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">جوجل بلس</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('google')) error @endif">
                                            {{ Form::text('google',$setting['google']->value,array('id'=>'google','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('google'))
                                            <label id="google-error" class="error"
                                                   for="google">{{ $errors->first('google') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">يوتيوب</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('youtube')) error @endif">
                                            {{ Form::text('youtube',$setting['youtube']->value,array('id'=>'youtube','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('youtube'))
                                            <label id="youtube-error" class="error"
                                                   for="youtube">{{ $errors->first('youtube') }}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">لينكد ان</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('linkedin')) error @endif">
                                            {{ Form::text('linkedin',$setting['linkedin']->value,array('id'=>'linkedin','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('linkedin'))
                                            <label id="linkedin-error" class="error"
                                                   for="linkedin">{{ $errors->first('linkedin') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">انستجرام</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('instagram')) error @endif">
                                            {{ Form::text('instagram',$setting['instagram']->value,array('id'=>'instagram','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('instagram'))
                                            <label id="instagram-error" class="error"
                                                   for="instagram">{{ $errors->first('instagram') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">Pinterest</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('pinterest')) error @endif">
                                            {{ Form::text('pinterest',$setting['pinterest']->value,array('id'=>'pinterest','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('pinterest'))
                                            <label id="pinterest-error" class="error"
                                                   for="pinterest">{{ $errors->first('pinterest') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">RSS</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('rss')) error @endif">
                                            {{ Form::text('rss',$setting['rss']->value,array('id'=>'rss','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('rss'))
                                            <label id="rss-error" class="error"
                                                   for="rss">{{ $errors->first('rss') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">Behance</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('behance')) error @endif">
                                            {{ Form::text('behance',$setting['behance']->value,array('id'=>'behance','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('behance'))
                                            <label id="behance-error" class="error"
                                                   for="behance">{{ $errors->first('behance') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">Snapchat</h2>
                                    <div class="form-group">
                                        <div class="form-line @if($errors->has('snapchat')) error @endif">
                                            {{ Form::text('snapchat',isset($setting['snapchat']->value) ? $setting['snapchat']->value : '',array('id'=>'snapchat','class'=>'form-control', 'placeholder'=>'')) }}
                                        </div>
                                        @if ($errors->has('snapchat'))
                                            <label id="snapchat-error" class="error"
                                                   for="snapchat">{{ $errors->first('snapchat') }}</label>
                                        @endif
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                            </div>


                        </div>

                        {{ Form::submit('حفظ',array('value'=>'Submit','class'=>'btn bg-teal waves-effect')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@endsection