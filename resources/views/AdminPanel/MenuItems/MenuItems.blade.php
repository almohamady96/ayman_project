@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            <li><a href="{{ URL::to('/AdminPanel/Menus') }}">إداره القوائم</a></li>
            <li class="active">{{$PageTitle}}</li>

        </ol>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            إضافه عنصر جديد للقائمه
                            <small>تستطيع التحكم فى بيانات العنصر الجديد من هنا</small>
                        </h2>
                    </div>

                    <div class="body">
                        {!! Form::open(['url'=>url('/AdminPanel/Menus/'.$menu->id.'/Items/CreateMenuItem'),'method'=>'post']) !!}
                        {!! csrf_field() !!}
                        <div class="row clearfix">

                            <div class="col-sm-3">
                                <h2 class="card-inside-title">عنوان العنصر باللغة العربية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('item_name_ar')) error @endif">
                                        {{ Form::text('item_name_ar','',array('id'=>'item_name_ar','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('item_name_ar'))
                                        <label id="item_name_ar-error" class="error"
                                               for="item_name_ar">{{ $errors->first('item_name_ar') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <h2 class="card-inside-title">عنوان العنصر باللغة الإنجليزية</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('item_name_en')) error @endif">
                                        {{ Form::text('item_name_en','',array('id'=>'item_name_en','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('item_name_en'))
                                        <label id="item_name_en-error" class="error"
                                               for="item_name_en">{{ $errors->first('item_name_en') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h2 class="card-inside-title">نوع العنصر</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('item_type')) error @endif">
                                        {{ Form::select('item_type',[
                                                                        'page'=>'صفحه ثابته',
                                                                        'category'=>'قسم',
                                                                        'article'=>'مقال',
                                                                        'external'=>'رابط خارجي',
                                                                        'photos'=>'ألبوم الصور',
                                                                        'videos'=>'مكتبة الفيديو',
                                                                        'about'=>'صفحة من نحن',
                                                                        'contact'=>'صفحة اتصل بنا',
                                                                        'Services'=>'صفحة الدورات التدريبية',
                                                                        'TeamWork'=>'صفحة فريق العمل',
                                                                        'Centers'=>'صفحة مراكز صديقة',
                                                                        'Clients'=>'صفحة عملائنا',
                                                                        'Certificate'=>'صفحة الإعتمادات',
                                                                        ],'',array('required'=>true,'id'=>'item_type','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                    </div>
                                    @if ($errors->has('item_type'))
                                        <label id="item_type-error" class="error"
                                               for="item_type">{{ $errors->first('item_type') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <h2 class="card-inside-title">عنصر رئيسي ؟</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('item_parent_id')) error @endif">
                                        {{ Form::select('item_parent_id',$select_parent,'',array('id'=>'item_parent_id','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                    </div>
                                    @if ($errors->has('item_parent_id'))
                                        <label id="item_parent_id-error" class="error"
                                               for="item_parent_id">{{ $errors->first('item_parent_id') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3" id="page">
                                <h2 class="card-inside-title">الصفحه</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('page_linked_id')) error @endif">
                                        {{ Form::select('page_linked_id',$select_page,'',array('id'=>'page_linked_id','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                    </div>
                                    @if ($errors->has('page_linked_id'))
                                        <label id="page_linked_id-error" class="error"
                                               for="page_linked_id">{{ $errors->first('page_linked_id') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3" id="category">
                                <h2 class="card-inside-title">القسم</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('category_linked_id')) error @endif">
                                        {{ Form::select('category_linked_id',$select_category,'',array('id'=>'category_linked_id','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                    </div>
                                    @if ($errors->has('category_linked_id'))
                                        <label id="category_linked_id-error" class="error"
                                               for="category_linked_id">{{ $errors->first('category_linked_id') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3" id="article">
                                <h2 class="card-inside-title">المقال</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('article_linked_id')) error @endif">
                                        {{ Form::select('article_linked_id',$select_article,'',array('id'=>'article_linked_id','class'=>'form-control show-tick','data-live-search'=>true)) }}
                                    </div>
                                    @if ($errors->has('article_linked_id'))
                                        <label id="article_linked_id-error" class="error"
                                               for="article_linked_id">{{ $errors->first('article_linked_id') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3" id="external">
                                <h2 class="card-inside-title">الرابط</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('external_link')) error @endif">
                                        {{ Form::text('external_link','',array('id'=>'external_link','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('external_link'))
                                        <label id="external_link-error" class="error"
                                               for="external_link">{{ $errors->first('external_link') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <h2 class="card-inside-title">الترتيب</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('number')) error @endif">
                                        {{ Form::number('number','',array('min'=>1,'id'=>'number','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('number'))
                                        <label id="number-error" class="error"
                                               for="number">{{ $errors->first('number') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        {{ Form::submit('إضافه',array('value'=>'حفظ','class'=>'btn bg-teal waves-effect')) }}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            {{$PageTitle}}
                            <small></small>
                        </h2>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم العنصر</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1; ?>
                            @foreach($items as $item)
                                <?php
                                $subItems = \App\MenuItem::where('item_id', '=', $item->id)
                                    ->where('menu_id', '=', $item->menu_id)
                                    ->orderBy('number', 'asc')
                                    ->orderBy('id', 'desc')
                                    ->get();?>
                                <tr id="row_{{ $item->id }}">
                                    <td>{{$x}}</td>
                                    <td>
                                        {{$item->name_ar}}
                                        <br>
                                        {{$item->name_en}}
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ URL::to('/AdminPanel/Menus/'.$item->menu_id.'/Items/'.$item->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل" style="margin: auto">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Menus/'.$item->menu_id.'/Items/'.$item->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف " style="margin: auto">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>

                                <?php $y = 1; ?>
                                @foreach($subItems as $subItem)
                                    <tr id="row_{{ $subItem->id }}">
                                        <td>{{$y}}</td>
                                        <td>
                                            -- {{$subItem->name_ar}}
                                            <br>
                                            -- {{$subItem->name_en}}
                                            <p style="margin-top: 10px">
                                                <span class="label bg-purple">عنصر فرعي لـ {{$item->name_ar}}</span>
                                            </p>
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ URL::to('/AdminPanel/Menus/'.$subItem->menu_id.'/Items/'.$subItem->id.'/Edit') }}"
                                               class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                               data-placement="top" title="تعديل" style="margin: auto">
                                                <i class="material-icons">settings</i>
                                            </a>
                                            <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Menus/'.$subItem->menu_id.'/Items/'.$subItem->id.'/Delete') }}')"
                                                    class="btn bg-red waves-effect"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="حذف " style="margin: auto">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                        </td>
                                    </tr>
                                        <?php
                                        $subItems2 = \App\MenuItem::where('item_id', '=', $subItem->id)
                                            ->where('menu_id', '=', $subItem->menu_id)
                                            ->orderBy('number', 'asc')
                                            ->orderBy('id', 'desc')
                                            ->get();?>
                                        <?php $z = 1; ?>
                                        @foreach($subItems2 as $subItem2)
                                            <tr id="row_{{ $subItem2->id }}">
                                                <td>{{$z}}</td>
                                                <td>
                                                    -- -- {{$subItem2->name_ar}}
                                                    <br>
                                                    -- -- {{$subItem2->name_en}}
                                                    <p style="margin-top: 10px">
                                                        <span class="label bg-purple">عنصر فرعي لـ {{$subItem->name_ar}}</span>
                                                    </p>
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ URL::to('/AdminPanel/Menus/'.$subItem2->menu_id.'/Items/'.$subItem2->id.'/Edit') }}"
                                                    class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                                    data-placement="top" title="تعديل" style="margin: auto">
                                                        <i class="material-icons">settings</i>
                                                    </a>
                                                    <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Menus/'.$subItem2->menu_id.'/Items/'.$subItem2->id.'/Delete') }}')"
                                                            class="btn bg-red waves-effect"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="حذف " style="margin: auto">
                                                        <i class="material-icons">delete_forever</i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $z++ ?>
                                        @endforeach
                                    <?php $y++ ?>
                                @endforeach
                                <?php $x++?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Users -->
    </div>
@stop


@section('script')
    <script>
        $(document).ready(function () {
            if ($('#item_type').val() == 'page') {
                $('#page').show();
                $('#category').hide();
                $('#article').hide();
                $('#external').hide();
            } else if ($('#item_type').val() == 'category') {
                $('#page').hide();
                $('#category').show();
                $('#article').hide();
                $('#external').hide();
            } else if ($('#item_type').val() == 'article') {
                $('#page').hide();
                $('#category').hide();
                $('#article').show();
                $('#external').hide();
            } else if ($('#item_type').val() == 'external') {
                $('#page').hide();
                $('#category').hide();
                $('#article').hide();
                $('#external').show();
            } else {
                $('#page').hide();
                $('#category').hide();
                $('#article').hide();
                $('#external').hide();
            }

            $('#item_type').change(function () {
                if ($('#item_type').val() == 'page') {
                    $('#page').show();
                    $('#category').hide();
                    $('#article').hide();
                    $('#external').hide();
                } else if ($('#item_type').val() == 'category') {
                    $('#page').hide();
                    $('#category').show();
                    $('#article').hide();
                    $('#external').hide();
                } else if ($('#item_type').val() == 'article') {
                    $('#page').hide();
                    $('#category').hide();
                    $('#article').show();
                    $('#external').hide();
                } else if ($('#item_type').val() == 'external') {
                    $('#page').hide();
                    $('#category').hide();
                    $('#article').hide();
                    $('#external').show();
                } else {
                    $('#page').hide();
                    $('#category').hide();
                    $('#article').hide();
                    $('#external').hide();
                }
            });
        });
    </script>
@endsection
