@extends('wow_souq.layouts.app')

@section('wow_souq')



    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div
                    class="banner_content d-md-flex justify-content-between align-items-center"
                >
                    <div class="mb-3 mb-md-0">
                        <h2>Cart</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="cart.html">Cart</a>
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
                                        <a class="gray_btn" href="#">Continue Shopping</a>
                                        {{--                                    <a class="main_btn" href="{{route('client.remove',['id' => $product['item']['id']])}}">Proceed to checkout</a>--}}
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


    {{--    @if(Session::has('cart'))--}}
    {{--        <main class="cart" style="padding: 5rem 10rem;">--}}
    {{--            <div class="media" id="order1">--}}
    {{--                <h4> المبلغ الكلى : {{$totalPrice}} ريال</h4>--}}
    {{--            </div>--}}
    {{--            @foreach($products as $product)--}}
    {{--                <div class="media" id="order1">--}}
    {{--                    <img src="{{asset('')}}front/img/images/burger-cheeseburger-delicious-1624473.jpg" class="mr-3"--}}
    {{--                         alt="...">--}}
    {{--                    <div class="media-body">--}}
    {{--                        <h5 class="mt-0">بيف برجر {{$product['item']['name']}} جرام</h5>--}}
    {{--                        <h5 class="mt-0">{{$product['item']['price']}} ريال</h5>--}}
    {{--                        <h5 class="mt-0">البائع : {{$product['item']['restaurant']['name']}}</h5>--}}
    {{--                        <h5 class="mt-0">الكمية : <span--}}
    {{--                                style="width: 3rem;background-color:#c9c9c9;border: unset">{{$product['qty']}}</span>--}}
    {{--                        </h5>--}}
    {{--                        <button type="button" class="btn btn-primary btn-lg" id="deleteOrder1">--}}
    {{--                            <i class="far fa-times-circle" style="font-size: 1.5rem;"></i>--}}
    {{--                            <a style="display: inline" class="h4"--}}
    {{--                               href="{{route('client.reduceByOne',['id' => $product['item']['id']])}}">مسح منتج واحد</a>--}}
    {{--                        </button>--}}
    {{--                        <button type="button" class="btn btn-primary btn-lg" id="deleteOrder1">--}}
    {{--                            <i class="far fa-times-circle" style="font-size: 1.5rem;"></i>--}}
    {{--                            <a style="display: inline" class="h4"--}}
    {{--                               href="{{route('client.remove',['id' => $product['item']['id']])}}">مسح</a>--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endforeach--}}

    {{--            <button type="button" class="btn btn-primary btn-lg" id="deleteOrder1">--}}
    {{--                <i class="fa fa-shopping-cart" style="font-size: 2rem;"></i>--}}
    {{--                <a style="display: inline" class="h4"--}}
    {{--                   href="{{url('/client/checkout')}}">شراء</a>--}}
    {{--            </button>--}}
    {{--        </main>--}}
    {{--    @else--}}
    {{--        <div class="alert alert-danger text-center">--}}
    {{--            <h3>لا توجد منتجات</h3>--}}
    {{--        </div>--}}
    {{--    @endif--}}


@endsection
