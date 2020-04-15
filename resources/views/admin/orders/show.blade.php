@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.orders')}}
@endsection
@section('small_title')
    {{trans('admin.order')}}
@endsection

@section('content')
    <section class="content" id="printableArea">


        <div class="box box-primary">
            <div class="box-body">

                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> تفاصيل طلب # {{$order->id}}
                                <small class="pull-left"><i class="fa fa-calendar-o"></i> {{$order->created_at}}
                                </small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            طلب من
                            <address>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> {{$order->client->name}} <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> الهاتف : {{$order->client->phone}} <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> البريد الإلكترونى : {{$order->client->email}}
                                <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> العنوان : {{$order->client->neighborhood->city->name}} - {{$order->client->neighborhood->name}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            المطعم :
                            <address>
                                <i class="fa fa-angle-left" aria-hidden="true"></i><strong> {{$order->restaurant->name}}</strong><br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> البريد الإلكترونى : {{$order->restaurant->email}}<br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> الهاتف :{{$order->restaurant->phone}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b> رقم الفاتورة #{{$order->id}}</b><br>
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b>  تفاصيل الطلب: {{$order->note}} </b><br> {{-- --}}
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b> حالةالطلب:{{$order->state}}</b>
                            <br>
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b> الإجمالى:</b> {{$order->total}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>إسم المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                    <th>ملاحظة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$product->name}}</td>
                                        <td>

                                            {{$product->pivot->qty}}

                                        </td>
                                        <td>{{$product->pivot->price}}</td>
                                        <td>{{$product->pivot->note}}</td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td>--</td>
                                    <td>تكلفة التوصيل</td>
                                    <td>-</td>
                                    <td>{{$order->delivery}}</td>
                                    <td></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>--</td>
                                    <td>الإجمالي</td>
                                    <td>-</td>
                                    <td>
                                        {{$order->total}}   ريال سعودى
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="" class="btn btn-primary" onclick="printDiv('printableArea')" id="print-all">
                                <i class="fa fa-print"></i> {{trans('admin.print')}} </a>
                            <script>
                                function printDiv(divName) {
                                    var printContents = document.getElementById(divName).innerHTML;
                                    var originalContents = document.body.innerHTML;
                                    document.body.innerHTML = printContents;
                                    window.print();
                                    document.body.innerHTML = originalContents;
                                }
                            </script>
                            {{--                            <input type="button" class="btn btn-primary" onclick="printDiv('printableArea')" value="{{trans('admin.print')}}" />--}}
                            {{--                            <br>--}}
                        </div>
                    </div>
                </section><!-- /.content -->
                <div class="clearfix"></div>

            </div>
        </div>


    </section>
@endsection
