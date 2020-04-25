@extends('wow_souq.layouts.app')
{{--@inject('payment_method', 'App\Model\PaymentMethod')--}}

@push('js')
    <?php

    $lat = !empty(old('lat')) ? old('lat') : '30.06303689611116';
    $lng = !empty(old('lng')) ? old('lng') : '31.23264503479004';

    ?>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{ $lat }},
                longitude: {{ $lng }},
            },
            radius: 300,
            markerIcon: "{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                // radiusInput: $('#us2-radius'),
                locationNameInput: $('#address')
            }

        });
    </script>
@endpush


@section('wow_souq')

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                @include('partials.validations_errors')
                @include('flash::message')
                <div
                    class="banner_content d-md-flex justify-content-between align-items-center"
                >
                    <div class="mb-3 mb-md-0">
                        <h2>Cart</h2>
                    </div>
                    <div class="page_link">
                        <a href="{{url('/')}}">Home</a>
                        <a href="#">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->


    <!--================Cart Area =================-->
    @if(Session::has('cart'))
        <section class="cart_area">
            <div class="container">
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img
                                                    src="img/product/single-product/cart-1.jpg"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="media-body">
                                                <p>{{$product['item']['name']}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>${{$product['item']['price']}}</h5>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="product_count">
                                            <input
                                                type="text"
                                                name="qty"
                                                id="sst"
                                                maxlength="12"
                                                value="{{$product['qty']}}"
                                                title="Quantity:"
                                                class="input-text qty"
                                            />
                                            <form method="get"
                                                  action="{{ route('client.getAddToCart', ['id' => $product['item']['id']]) }}">
                                                {!! csrf_field() !!}
                                                <button
                                                    {{--                                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"--}}
                                                    class="increase items-count"
                                                    type="submit"
                                                >
                                                    <i class="lnr lnr-chevron-up"></i>
                                                </button>
                                            </form>
                                            <form method="get"
                                                  action="{{ route('client.reduceByOne', ['id' => $product['item']['id']]) }}">
                                                {!! csrf_field() !!}
                                                <button
                                                    {{-- onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"--}}
                                                    class="reduced items-count"
                                                    type="submit"
                                                >
                                                    <i class="lnr lnr-chevron-down"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        {{--                                        <a class="gray_btn"--}}
                                        {{--                                           href="{{route('client.reduceByOne',['id' => $product['item']['id']])}}">Remove--}}
                                        {{--                                            One</a>--}}
                                        <a class="main_btn"
                                           href="{{route('client.remove',['id' => $product['item']['id']])}}">Remove
                                            All</a>
                                    </td>
                                </tr>
                            @endforeach
                            {{--                        <tr class="bottom_button">--}}
                            {{--                            <td>--}}
                            {{--                                <a class="gray_btn" href="#">Update Cart</a>--}}
                            {{--                            </td>--}}
                            {{--                            <td></td>--}}
                            {{--                            <td></td>--}}
                            {{--                            <td>--}}
                            {{--                                <div class="cupon_text">--}}
                            {{--                                    <input type="text" placeholder="Coupon Code" />--}}
                            {{--                                    <a class="main_btn" href="#">Apply</a>--}}
                            {{--                                    <a class="gray_btn" href="#">Close Coupon</a>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}
                            {{--                        </tr>--}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>${{$totalPrice}}</h5>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner">
                                        <button class="btn gray_btn" data-toggle="modal" data-target="#shopping_cart">
                                            Continue Shopping
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="alert alert-danger text-center">
            <h3>لا توجد منتجات</h3>
        </div>
    @endif
    <!--================End Cart Area =================-->


    <!-- Modal -->
    <div id="shopping_cart" class="modal fade bd-example-modal-lg" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ trans('admin.Config Request') }}</h4>
                </div>
                {!! Form::open(['route'=>'wowsouq.client.add.order', 'method'=>'POST']) !!}
                <div class="modal-body">

                    <input type="hidden" value="{{ $lat }}" id="lat" name="latitude">
                    <input type="hidden" value="{{ $lng }}" id="lng" name="longitude">


                    <style>
                        .nice-select {
                            width: 100%;
                        }

                        .nice-select .option {
                            width: 750px;
                        }
                    </style>

                    <div class="banner_content row" style="margin-bottom: 20px">
                        <div class="col-lg-12">
                            <div>
                                <label for="payment_method_id" style=""
                                       class="col-form-label">{{trans('web.payment_method_id')}}</label>
                            </div>
                            <select name="payment_method_id" id="payment_method_id" required>
                                <option value="0">{{trans('web.no_data')}}</option>
                                @foreach($payment_method as $index)
                                    <option value="{{$index->id}}">{{$index->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="note">{{trans('admin.note')}}</label>
                        {!! Form::textarea('note', null , ['class' => 'form-control', 'rows' => 4]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', trans('admin.address')) !!}
                        {!! Form::text('address', old('address'), ['class'=>'form-control address']) !!}
                    </div>

                    <div class="form-group">
                        <div id="us1" style="width: 100%; height: 200px;"></div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('admin.no') }}</button>
                    {!! Form::submit(trans('admin.submit'), ['class'=>'btn btn-info']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>


@endsection
