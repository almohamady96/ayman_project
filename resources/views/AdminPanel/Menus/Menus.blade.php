@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>
            <li class="active">{{$PageTitle}}</li>

        </ol>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            إضافه قائمه جديده
                            <small>تستطيع التحكم فى بيانات القائمه الجديده من هنا</small>
                        </h2>
                    </div>

                    <div class="body">
                        {!! Form::open(['url'=>url('/AdminPanel/Menus/CreateMenu'),'method'=>'post']) !!}
                        {!! csrf_field() !!}
                        <div class="row clearfix">

                            <div class="col-sm-6">
                                <h2 class="card-inside-title">عنوان القائمه</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('menu_name')) error @endif">
                                        {{ Form::text('menu_name','',array('required'=>true,'id'=>'menu_name','class'=>'form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('menu_name'))
                                        <label id="menu_name-error" class="error"
                                               for="menu_name">{{ $errors->first('menu_name') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title">مكان القائمه</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('menu_position')) error @endif">
                                        {{ Form::select('menu_position',[
                                                                        'header'=>'هيدر الموقع',
                                                                        'header2'=>'القائمة الثانية فى الهيدر',
                                                                        'phone'=>'قائمة الهاتف',
                                                                        'footer'=>'فوتر الموقع',
                                                                        ],'',array('required'=>true,'id'=>'menu_position','class'=>'form-control show-tick')) }}
                                    </div>
                                    @if ($errors->has('menu_position'))
                                        <label id="menu_position-error" class="error"
                                               for="menu_position">{{ $errors->first('menu_position') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::submit('إضافه',array('value'=>'حفظ','class'=>'btn bg-teal waves-effect')) }}

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2>
                            {{$PageTitle}}
                            <small>ملحوظه : إذا قمت بإنشاء أكتر من قائمه تعرض في نفس المكان يتم عرض القائمه المضافه حديثاً فقط</small>
                        </h2>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان القائمه</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1 ?>
                            @foreach($menus as $menu)
                                <?php
                                    if($menu->position =='header'){
                                        $position='هيدر الموقع';
                                        $position_color='bg-pink';
                                    }elseif($menu->position =='header2'){
                                        $position='القائمة الثانية فى الهيدر';
                                        $position_color='bg-purple';
                                    }elseif($menu->position =='phone'){
                                        $position='قائمة الهاتف';
                                        $position_color='bg-purple';
                                    }elseif($menu->position =='footer'){
                                        $position='فوتر الموقع';
                                        $position_color='bg-purple';
                                    }
                                ?>
                                <tr id="row_{{ $menu->id }}">
                                    <td>{{$x}}</td>
                                    <td>
                                        {{$menu->name}}
                                        <p style="margin-top: 10px">
                                            <span class="label {{$position_color}}">{{$position}}</span>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('/AdminPanel/Menus/'.$menu->id.'/Items') }}"
                                           class="btn bg-light-blue waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="عناصر قائمه {{$menu->name}}" style="margin: auto">
                                            <i class="material-icons">list</i>
                                        </a>

                                        <a href="{{ URL::to('/AdminPanel/Menus/'.$menu->id.'/Edit') }}"
                                           class="btn bg-light-green waves-effect" data-toggle="tooltip"
                                           data-placement="top" title="تعديل" style="margin: auto">
                                            <i class="material-icons">settings</i>
                                        </a>
                                        <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Menus/'.$menu->id.'/Delete') }}')"
                                                class="btn bg-red waves-effect"
                                                data-toggle="tooltip"
                                                data-placement="top" title="حذف " style="margin: auto">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
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