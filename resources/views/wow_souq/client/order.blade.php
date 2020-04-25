@extends('wow_souq.layouts.app')

@section('wow_souq')


    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="background-color: #bbbbbb">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                       aria-selected="true">
                        Old Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false">
                        Current Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                       aria-controls="review" aria-selected="false">
                        New Orders
                    </a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent" style="background-color: #eeeeee">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        @if(auth('clients')->user()->orders->whereIn('status', ['rejected', 'delivered', 'declined'])->count() != 0)
                            @foreach(auth('clients')->user()->orders->whereIn('status', ['rejected', 'delivered', 'declined']) as $order)
                                <div class="col-sm-6">
                                    <div class="card @if(session('lang') === 'en') @else text-right @endif"
                                         style="margin-bottom: 20px">
                                        <h5 class="card-header"
                                            style="background-color: #cccccc">{{trans('web.order_number')}}
                                            : {{$order->order_number}}</h5>
                                        <div class="card-body">
                                            <h4 class="card-title">{{trans('web.total')}}: {{ $order->total }}</h4>
                                            <h6 class="card-text">{{trans('web.price')}}: {{ $order->price }}</h6>
                                            <h6 class="card-text">{{trans('web.delivery')}}
                                                : {{ $order->delivery }}</h6>
                                            <h6 class="card-text">{{trans('web.status')}} :
                                                @if ($order->status == 'rejected')
                                                    {{trans('web.rejected')}}
                                                @elseif ($order->status == 'delivered')
                                                    {{trans('web.delivered')}}
                                                @elseif ($order->status == 'declined')
                                                    {{trans('web.declined')}}
                                                @endif
                                            </h6>
                                            <p class="card-text">{{trans('web.note')}}: {{ $order->note }}</p>

                                            <a class="btn btn-success circle" data-toggle="modal"
                                               data-target="#show_old_order"
                                               style="color: #ffffff">{{trans('web.showRequest')}}</a>
                                        </div>
                                    </div>
                                </div>



                                <!-- Modal Show -->
                                <div id="show_old_order" class="modal fade bd-example-modal-lg" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p>تاريخ الطلب : {{ $order->created_at }}</p>
                                                <p style="font-size: 20px">تفاصيل الطلب رقم
                                                    : {{ $order->order_number }}</p>
                                            </div>
                                            <div class="modal-body" style="color: #0a0a0a">
                                                <div class="invoice-col @if(session('lang') === 'en') @else text-right @endif" style="margin-bottom: 20px">

                                                    <h4>
                                                        {{trans('admin.price')}}
                                                        : {{$order->price}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.delivery')}}
                                                        : {{$order->delivery}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.total')}}
                                                        : {{$order->total}}
                                                    </h4>
                                                </div><!-- /.col -->
                                                <table class="table table-hover table-sm text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">{{trans('web.product_name')}}</th>
                                                        <th scope="col">{{trans('web.quantity')}}</th>
                                                        <th scope="col">{{trans('web.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->products as $product)
                                                        <tr>
                                                            <th scope="row">{{$product->id}}</th>
                                                            <td>{{$product->name}}</td>
                                                            <td>{{$product->pivot->qty}}</td>
                                                            <td>{{$product->pivot->price}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        @else
                            <div class="alert alert-danger col-lg-12 text-center" style="font-size: 20px">
                                {{trans('web.no_data_old')}}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        @if(auth('clients')->user()->orders->where('status', 'accepted')->count() != 0)
                            @foreach(auth('clients')->user()->orders->where('status', 'accepted') as $order)
                                <div class="col-sm-6">
                                    <div class="card @if(session('lang') === 'en') @else text-right @endif"
                                         style="margin-bottom: 20px">
                                        <h5 class="card-header"
                                            style="background-color: #cccccc">{{trans('web.order_number')}}
                                            : {{$order->order_number}}</h5>
                                        <div class="card-body">
                                            <h4 class="card-title">{{trans('web.total')}}: {{ $order->total }}</h4>
                                            <h6 class="card-text">{{trans('web.price')}}: {{ $order->price }}</h6>
                                            <h6 class="card-text">{{trans('web.delivery')}}: {{ $order->delivery }}</h6>
                                            <h6 class="card-text">{{trans('web.status')}}
                                                : @if ($order->status == 'accepted'){{trans('web.accepted')}}@endif</h6>
                                            <p class="card-text">{{trans('web.note')}}: {{ $order->note }}</p>

                                            <a class="btn btn-success circle" data-toggle="modal"
                                               data-target="#show_current_order"
                                               style="color: #ffffff">{{trans('web.showRequest')}}</a>
                                        </div>
                                    </div>
                                </div>



                                <!-- Modal Show -->
                                <div id="show_current_order" class="modal fade bd-example-modal-lg" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p>تاريخ الطلب : {{ $order->created_at }}</p>
                                                <p style="font-size: 20px">تفاصيل الطلب رقم
                                                    : {{ $order->order_number }}</p>
                                            </div>
                                            <div class="modal-body" style="color: #0a0a0a">
                                                <div class="invoice-col @if(session('lang') === 'en') @else text-right @endif" style="margin-bottom: 20px">

                                                    <h4>
                                                        {{trans('admin.price')}}
                                                        : {{$order->price}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.delivery')}}
                                                        : {{$order->delivery}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.total')}}
                                                        : {{$order->total}}
                                                    </h4>
                                                </div><!-- /.col -->
                                                <table class="table table-hover table-sm text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">{{trans('web.product_name')}}</th>
                                                        <th scope="col">{{trans('web.quantity')}}</th>
                                                        <th scope="col">{{trans('web.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->products as $product)
                                                        <tr>
                                                            <th scope="row">{{$product->id}}</th>
                                                            <td>{{$product->name}}</td>
                                                            <td>{{$product->pivot->qty}}</td>
                                                            <td>{{$product->pivot->price}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="alert alert-danger col-lg-12 text-center" style="font-size: 20px">
                                {{trans('web.no_data_current')}}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        @if(auth('clients')->user()->orders->where('status', 'pending')->count() != 0)
                            @foreach(auth('clients')->user()->orders->where('status', 'pending') as $order)
                                <div class="col-sm-6">
                                    <div class="card @if(session('lang') === 'en') @else text-right @endif"
                                         style="margin-bottom: 20px">
                                        <h5 class="card-header"
                                            style="background-color: #cccccc">{{trans('web.order_number')}}
                                            : {{$order->order_number}}</h5>
                                        <div class="card-body">
                                            <h4 class="card-title">{{trans('web.total')}}: {{ $order->total }}</h4>
                                            <h6 class="card-text">{{trans('web.price')}}: {{ $order->price }}</h6>
                                            <h6 class="card-text">{{trans('web.delivery')}}: {{ $order->delivery }}</h6>
                                            <h6 class="card-text">{{trans('web.status')}}
                                                : @if ($order->status == 'pending'){{trans('web.pending')}}@endif</h6>
                                            <p class="card-text">{{trans('web.note')}}: {{ $order->note }}</p>

                                            <a class="btn btn-success circle" data-toggle="modal"
                                               data-target="#show_new_order"
                                               style="color: #ffffff">{{trans('web.showRequest')}}</a>

                                            <a class="btn btn-danger circle" data-toggle="modal"
                                               data-target="#delete_new_order"
                                               style="color: #ffffff">{{trans('web.cancelRequest')}}</a>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div id="delete_new_order" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            {!! Form::open(['route'=>['wowsouq.client.order.rejected',$order->id], 'method'=>'delete']) !!}
                                            <div class="modal-body">
                                                <h4>{{ trans('admin.cancel_this',['name'=>$order->order_number]) }}</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info"
                                                        data-dismiss="modal">{{ trans('admin.no') }}</button>
                                                {!! Form::submit(trans('admin.yes'), ['class'=>'btn btn-danger']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Show -->
                                <div id="show_new_order" class="modal fade bd-example-modal-lg" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p>تاريخ الطلب : {{ $order->created_at }}</p>
                                                <p style="font-size: 20px">تفاصيل الطلب رقم
                                                    : {{ $order->order_number }}</p>
                                            </div>
                                            <div class="modal-body" style="color: #0a0a0a">
                                                <div class="invoice-col @if(session('lang') === 'en') @else text-right @endif" style="margin-bottom: 20px">

                                                    <h4>
                                                        {{trans('admin.price')}}
                                                        : {{$order->price}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.delivery')}}
                                                        : {{$order->delivery}}
                                                    </h4>
                                                    <h4>
                                                        {{trans('admin.total')}}
                                                        : {{$order->total}}
                                                    </h4>
                                                </div><!-- /.col -->
                                                <table class="table table-hover table-sm text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">{{trans('web.product_name')}}</th>
                                                        <th scope="col">{{trans('web.quantity')}}</th>
                                                        <th scope="col">{{trans('web.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->products as $product)
                                                        <tr>
                                                            <th scope="row">{{$product->id}}</th>
                                                            <td>{{$product->name}}</td>
                                                            <td>{{$product->pivot->qty}}</td>
                                                            <td>{{$product->pivot->price}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endforeach
                        @else
                            <div class="alert alert-danger col-lg-12 text-center" style="font-size: 20px">
                                {{trans('web.no_data_current')}}
                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->


@endsection

