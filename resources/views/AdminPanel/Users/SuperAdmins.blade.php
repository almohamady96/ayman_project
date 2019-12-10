@extends('AdminPanel.layouts.AdminIndex')

@section('content')

    <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/AdminPanel') }}">لوحة التحكم</a></li>

            <li class="active">{{$PageTitle}}</li>
        </ol>
        <!-- Users -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>{{$PageTitle}}</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons bg-teal" >add</i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li><a href="{{ URL::to('/AdminPanel/Users/CreateUser') }}">عضو جديد</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الإسم</th>
                                <th>بيانات التواصل</th>
                                <th>الصلاحيات</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $X = 1 ?>
                            @foreach($users as $user)
                                @if($user->hasRole($role))
                                <?php
                                $firstAdmin = \App\UserRole::where('role_id', '=', 1)->first();
                                if($user->id == $firstAdmin->id){
                                    $form_click='disabled';
                                }else{
                                    $form_click='';
                                }
                                if ($user->isActive == 1) {
                                    $status = 'نشط';
                                    $statusColor = 'bg-teal';
                                } else {
                                    $status = 'غير نشط';
                                    $statusColor = 'bg-red';
                                }

                                if ($user->account_type == 'user'){
                                    $accType='مستخدم';
                                    $accTypeColor='bg-orange';
                                }else{
                                    $accType='تاجر';
                                    $accTypeColor='bg-purple';
                                }
                                ?>
                                <tr id="row_{{ $user->id }}">
                                    <td>{{$X}}</td>
                                    <td>
                                        <p>{{$user->name }}</p>
                                        <div style="margin-top: 15px">
                                            <span class="label {{$statusColor}}"
                                                  style="margin-right: 0px">{{$status}}</span>
                                            <span class="label {{$accTypeColor}}"
                                                  style="margin-right: 10px">{{$accType}}</span>


                                        </div>
                                    </td>
                                    <td>
                                        <p style="margin-top: 0px;margin-bottom: 5px">
                                            <span>رقم الهاتف : </span>
                                            <span class=" col-pink">
                                        {{$user->mobile != '' ? $user->mobile : '-----'}}
                                            </span>
                                        </p>
                                        <p style="margin-top: 5px;margin-bottom: 5px">
                                            <span>رقم الواتساب : </span>
                                            <span class=" col-pink">
                                        {{$user->whatsApp != '' ? $user->whatsApp : '-----'}}
                                            </span>
                                        </p>
                                        <p style="margin-top: 5px;margin-bottom: 5px">
                                            <span>البريد الإلكتروني : </span>
                                            <span class=" col-pink">
                                        {{$user->email}}
                                            </span>
                                        </p>

                                    </td>
                                    <td>
                                        <?php
                                        $roles = \App\Role::all();
                                        ?>
                                        <form action="{{url('/AdminPanel/Users/'.$user->id.'/ChangeRoles')}}" method="post">
                                            {!! csrf_field() !!}
                                            @foreach($roles as $role)

                                                <input name="role_id" type="radio" value="{{$role->id}}" onclick="this.form.submit();" {{$form_click}} id="user_{{$user->id}}_role_{{$role->id}}"
                                                       class="radio-col-teal"
                                                        {{$user->hasRole($role->id) ? 'checked' : ''}}>
                                                <label for="user_{{$user->id}}_role_{{$role->id}}">{{$role->name}}</label>
                                                <br>
                                            @endforeach
                                        </form>

                                    </td>


                                    <td class="text-center">

                                        @if($user->id != $firstAdmin->user_id && Auth::user()->id != $user->id)
                                            <a href="{{ URL::to('/AdminPanel/Users/'.$user->id.'/Edit') }}"
                                               class="btn bg-teal waves-effect"
                                               data-toggle="tooltip"
                                               data-placement="top" title="تعديل بيانات {{$user->fName}}">
                                                <i class="material-icons">settings</i>
                                            </a>
                                            <button onclick="showConfirmMessage('{{ URL::to('/AdminPanel/Users/'.$user->id.'/Delete') }}')"
                                                    class="btn bg-red waves-effect"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="حذف {{$user->fName}}">
                                                <i class="material-icons">delete_forever</i>
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                                <?php $X++?>
                                @endif
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