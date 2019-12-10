@extends('AdminPanel.layouts.AdminIndex')

@section('content')
    <div class="container-fluid">
        <!-- Users -->
        <ol class="breadcrumb breadcrumb-bg-teal">
            <li><a href="{{ URL::to('/ClientPanel') }}">لوحة التحكم</a></li>
            <li><a href="{{ URL::to('/ClientPanel/Orders') }}">إدارة المشتريات</a></li>
            <li class="active">عملية شراء / توريد جديدة</li>
        </ol>

    {!! Form::open(['files'=>true]) !!}
    <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            بيانات عملية الشراء
                            <small>املأ البيانات التالية</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <h2 class="card-inside-title">تاريخ عمليه الشراء</h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('date')) error @endif">
                                        {{ Form::text('date','',array('id'=>'date','class'=>'datepicker form-control', 'placeholder'=>'اختر تاريخ عملية الشراء')) }}
                                    </div>
                                    @if ($errors->has('date'))
                                        <label id="date-error" class="error"
                                               for="date">{{ $errors->first('date') }}</label>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                                {{--<h2 class="card-inside-title">المورد</h2>--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="form-line @if($errors->has('provider_id')) error @endif">--}}
                                        {{--{{ Form::select('provider_id',$select_provider,'',array('class'=>'form-control show-tick','data-live-search'=>'true'))}}--}}
                                    {{--</div>--}}
                                    {{--@if ($errors->has('provider_id'))--}}
                                        {{--<label id="provider_id-error" class="error"--}}
                                               {{--for="provider_id">{{ $errors->first('provider_id') }}</label>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="clearfix"></div>

                            <div class="">
                                <div id="all_products">

                                    {{--<div class="col-sm-4">
                                        <h2 class="card-inside-title"> المنتج <span class="small"> </span>
                                        </h2>
                                        <div class="form-group">
                                            <div class="form-line @if($errors->has('product_id')) error @endif">
                                                {{ Form::select('product_id[]',$select_product,'',array('id'=>'product_id','class'=>'form-control show-tick','data-live-search'=>'true'))}}
                                            </div>
                                            @if ($errors->has('product_id'))
                                                <label id="product_id-error" class="error"
                                                       for="product_id">{{ $errors->first('product_id') }}</label>
                                            @endif
                                        </div>
                                    </div>--}}

                                    <div class="col-sm-2">
                                        <h2 class="card-inside-title"> سعر الشراء<span
                                                    class="small"> (  أرقام فقط ) </span>
                                        </h2>
                                        <div class="form-group">
                                            <div class="form-line @if($errors->has('buyingPrice')) error @endif">
                                                {{ Form::number('buyingPrice[]','',array('min'=>1,'id'=>'buyingPrice','class'=>' form-control','required'=>'true')) }}
                                            </div>
                                            @if ($errors->has('buyingPrice'))
                                                <label id="buyingPrice-error" class="error"
                                                       for="buyingPrice">{{ $errors->first('buyingPrice') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <h2 class="card-inside-title"> الكميه<span class="small"> (  أرقام فقط ) </span>
                                        </h2>
                                        <div class="form-group">
                                            <div class="form-line @if($errors->has('product_amount')) error @endif">
                                                {{ Form::number('product_amount[]',1,array('min'=>1,'id'=>'product_amount','class'=>' form-control','required'=>'true')) }}
                                            </div>
                                            @if ($errors->has('product_amount'))
                                                <label id="product_amount-error" class="error"
                                                       for="product_amount">{{ $errors->first('product_amount') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <h2 class="card-inside-title"> سعر البيع الأدني<span
                                                    class="small"> ( إختياري ) </span></h2>
                                        <div class="form-group">
                                            <div class="form-line @if($errors->has('minPrice')) error @endif">
                                                {{ Form::number('minPrice[]','',array('min'=>1,'id'=>'minPrice','class'=>' form-control', 'placeholder'=>'')) }}
                                            </div>
                                            @if ($errors->has('minPrice'))
                                                <label id="minPrice-error" class="error"
                                                       for="minPrice">{{ $errors->first('minPrice') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <h2 class="card-inside-title">سعر البيع الأعلي <span
                                                    class="small"> ( إختياري) </span></h2>
                                        <div class="form-group">
                                            <div class="form-line @if($errors->has('maxPrice')) error @endif">
                                                {{ Form::number('maxPrice[]','',array('min'=>1,'id'=>'maxPrice','class'=>' form-control', 'placeholder'=>'')) }}
                                            </div>
                                            @if ($errors->has('maxPrice'))
                                                <label id="maxPrice-error" class="error"
                                                       for="maxPrice">{{ $errors->first('maxPrice') }}</label>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>

                            </div>

                            <div class="clearfix"></div>

                            <button id="add_product" class="btn btn-info btn-sm"
                                    style="margin-left: 20px ; margin-right: 20px; margin-bottom: 50px">
                                <i class="material-icons">add_box</i>
                                منتج أخر
                            </button>
                            <br>

                            <div class="clearfix"></div>
                            <div class="col-sm-4">
                                <h2 class="card-inside-title"> مصروفات إضافيه <span
                                            class="small"> (  أرقام فقط ) </span>
                                </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('extraMoney')) error @endif">
                                        {{ Form::number('extraMoney','',array('min'=>1,'id'=>'extraMoney','class'=>'extraMoneypicker form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('extraMoney'))
                                        <label id="extraMoney-error" class="error"
                                               for="extraMoney">{{ $errors->first('extraMoney') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <h2 class="card-inside-title"> مصروفات نقل <span class="small"> (  أرقام فقط ) </span>
                                </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('chargeMoney')) error @endif">
                                        {{ Form::number('chargeMoney','',array('min'=>1,'id'=>'chargeMoney','class'=>'chargeMoneypicker form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('chargeMoney'))
                                        <label id="chargeMoney-error" class="error"
                                               for="chargeMoney">{{ $errors->first('chargeMoney') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <h2 class="card-inside-title"> الخصم المسموح به<span
                                            class="small"> (  أرقام فقط ) </span>
                                </h2>
                                <div class="form-group">
                                    <div class="form-line @if($errors->has('saleMoney')) error @endif">
                                        {{ Form::number('saleMoney','',array('min'=>1,'id'=>'saleMoney','class'=>' form-control', 'placeholder'=>'')) }}
                                    </div>
                                    @if ($errors->has('saleMoney'))
                                        <label id="saleMoney-error" class="error"
                                               for="saleMoney">{{ $errors->first('saleMoney') }}</label>
                                    @endif
                                </div>
                            </div>


                            <div class="clearfix"></div>

                            {{--

                                                    <div class="col-sm-4">
                                                        <h2 class="card-inside-title"> المدفوع <span class="small"> (  أرقام فقط ) </span> </h2>
                                                        <div class="form-group">
                                                            <div class="form-line @if($errors->has('paidMoney')) error @endif">
                                                                {{ Form::text('paidMoney','',array('id'=>'paidMoney','class'=>'paidMoneypicker form-control', 'placeholder'=>'')) }}
                                                            </div>
                                                            @if ($errors->has('paidMoney'))
                                                                <label id="paidMoney-error" class="error" for="paidMoney">{{ $errors->first('paidMoney') }}</label>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <h2 class="card-inside-title">المتبقي<span class="small"> ( إختياري *  أرقام فقط ) </span> </h2>
                                                        <div class="form-group">
                                                            <div class="form-line @if($errors->has('restMoney')) error @endif">
                                                                {{ Form::text('restMoney','',array('id'=>'restMoney','class'=>' form-control', 'placeholder'=>'')) }}
                                                            </div>
                                                            @if ($errors->has('restMoney'))
                                                                <label id="restMoney-error" class="error" for="restMoney">{{ $errors->first('restMoney') }}</label>
                                                            @endif
                                                        </div>
                                                    </div>

                            --}}

                        </div>
                        {{ Form::submit('حفظ',array('class'=>'btn bg-teal waves-effect')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    {!! Form::close() !!}

@stop


@section('script')

    <script type="text/template" id="product_template">
        <div class="More">
{{--
            <div class="col-sm-3">
                <h2 class="card-inside-title"> المنتج <span class="small"> </span>
                </h2>
                <div class="form-group">
                    <div class="form-line @if($errors->has('product_id')) error @endif">
                        {{ Form::select('product_id[]',$select_product,'',array('id'=>'product_id','class'=>'form-control  show-tick','data-live-search'=>'true'))}}
                    </div>
                    @if ($errors->has('product_id'))
                        <label id="product_id-error" class="error"
                               for="product_id">{{ $errors->first('product_id') }}</label>
                    @endif
                </div>
            </div>
--}}

            <div class="col-sm-2">
                <h2 class="card-inside-title"> سعر الشراء<span
                            class="small"> (  أرقام فقط ) </span>
                </h2>
                <div class="form-group">
                    <div class="form-line @if($errors->has('buyingPrice')) error @endif">
                        {{ Form::number('buyingPrice[]','',array('min'=>1,'id'=>'buyingPrice','class'=>' form-control','required'=>'true')) }}
                    </div>
                    @if ($errors->has('buyingPrice'))
                        <label id="buyingPrice-error" class="error"
                               for="buyingPrice">{{ $errors->first('buyingPrice') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-2">
                <h2 class="card-inside-title"> الكميه<span class="small"> (  أرقام فقط ) </span>
                </h2>
                <div class="form-group">
                    <div class="form-line @if($errors->has('product_amount')) error @endif">
                        {{ Form::number('product_amount[]',1,array('min'=>1,'id'=>'product_amount','class'=>' form-control','required'=>'true')) }}
                    </div>
                    @if ($errors->has('product_amount'))
                        <label id="product_amount-error" class="error"
                               for="product_amount">{{ $errors->first('product_amount') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-2">
                <h2 class="card-inside-title"> سعر البيع الأدني<span
                            class="small"> ( إختياري ) </span></h2>
                <div class="form-group">
                    <div class="form-line @if($errors->has('minPrice')) error @endif">
                        {{ Form::number('minPrice[]','',array('min'=>1,'id'=>'minPrice','class'=>' form-control', 'placeholder'=>'')) }}
                    </div>
                    @if ($errors->has('minPrice'))
                        <label id="minPrice-error" class="error"
                               for="minPrice">{{ $errors->first('minPrice') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-2">
                <h2 class="card-inside-title">سعر البيع الأعلي <span
                            class="small"> ( إختياري) </span></h2>
                <div class="form-group">
                    <div class="form-line @if($errors->has('maxPrice')) error @endif">
                        {{ Form::number('maxPrice[]','',array('min'=>1,'id'=>'maxPrice','class'=>' form-control', 'placeholder'=>'')) }}
                    </div>
                    @if ($errors->has('maxPrice'))
                        <label id="maxPrice-error" class="error"
                               for="maxPrice">{{ $errors->first('maxPrice') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-1">
                <button type="button" class="delete btn bg-red"
                        data-toggle="tooltip"
                        data-placement="top" title="حذف المنتج">
                    <i class="material-icons">delete</i>
                </button>


            </div>
            <div class="clearfix"></div>
        </div>
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var max_fields = 100;
            var wrapper = $("#all_products");
            var add_button = $("#add_product");
            var RepeatOpponentTPL = $("#product_template").html();

            var x = 1;
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {

                    x++;
                    $(wrapper).append(RepeatOpponentTPL); //add input box
                } else {
                    alert('عفوا لقد وصلت أقصي عدد من المنتجات للفاتوره الواحده')
                }
            });

            $(wrapper).on("click", ".delete", function (e) {
                e.preventDefault();
                $(this).closest('.More').remove();
                x--;
            })
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#product_id').change(function () {
                var product_id = $('#product_id').val();
                $.ajax({
                    url: 'ClientPanel/ProductPrice/',
                    method: "post",
                    data: product_id,
                    async: true,
                    success: function (response) { // What to do if we succeed
                        if (data == "success")
                            $("#product_price").val(data);
                        alert(response);
                    },
                    error: function (response) {
                        alert('Error' + response);
                    }
                });

                //var product_id=$('#product_id').val();
                var product_price = '';
                console.log(product_id);
            });
        });

        /*
                $.ajax({
                    url: 'ClientPanel/ProductPrice/',
                    type: "get",
                    data: {id: data},
                    success: function (response) { // What to do if we succeed
                        if (data == "success")
                            $("#product_price").val(data);
                        alert(response);
                    },
                    error: function (response) {
                        alert('Error' + response);
                    }
                });
        */


        $(document).ready(function () {
            var total = $('#sales_total').val(this.val);

            $('#chargeMoney,#extraMoney,#saleMoney,#product_price,#product_amount').keyup(function () {
                    <?php
                    /*foreach ($request['product_id'] as $key1 => $value1) {
                        foreach ($request['product_price'] as $key2 => $value2) {
                            foreach ($request['product_amount'] as $key3 => $value3) {
                                if (($key1 == $key2) == $key3 && $value2 != '' && $value3 != '') {
                                    $product_total=$value2 *$value3;
                                }
                            }
                        }
                    }*/
                    ?>
                        {{--
                                           var product_price= Number($('#product_price').val());
                                           var product_amount=Number($('#product_amount').val());
                                            var product_total=product_price * product_amount;
                                            console.log(product_total);
                        --}}

                var product_total = Number($('#product_price').val()) * Number($('#product_amount').val());

                var price = [];
                $.each(price, function (index, value) {
                    price[0] = Number($('#product_price').val());
                });
                var new_total =
                    Number($('#extraMoney').val()) + Number($('#chargeMoney').val()) + Number($('#saleMoney').val());
                total.val(new_total);

            });


        });
    </script>


@stop
