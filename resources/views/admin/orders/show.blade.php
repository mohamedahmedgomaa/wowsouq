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
                            {{trans('admin.asked')}}
                            <address>
                                 {{$order->client->name}} <br>
                                 {{trans('admin.phone')}} : {{$order->client->phone}}
                                <br>
                                 {{trans('admin.email')}}
                                : {{$order->client->email}}
                                <br>
                                 {{trans('admin.address')}}
                                : {{$order->client->address}}
                            </address>
                        </div><!-- /.col -->

                        <div class="col-sm-4 invoice-col">
                            <b>{{trans('admin.order_id')}} : {{$order->id}}</b><br>
                            <b>{{trans('admin.note')}} : {{$order->note}} </b><br>
                            <b> {{trans('admin.status')}} : {{$order->status}}</b>
                            <br>
                            <b>{{trans('admin.total')}} : </b> {{$order->total}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.product_name')}}</th>
                                    <th>{{trans('admin.quantity')}}</th>
                                    <th>{{trans('admin.price')}}</th>
                                    <th>{{trans('admin.note')}}</th>
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
                                    <td>{{trans('admin.delivery')}}</td>
                                    <td>-</td>
                                    <td>{{$order->delivery}}</td>
                                    <td></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>--</td>
                                    <td>{{trans('admin.total')}}</td>
                                    <td>-</td>
                                    <td>
                                        {{$order->total}} $
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
