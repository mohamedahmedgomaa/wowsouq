@extends('wow_souq.layouts.app')

@section('wow_souq')

    @include('partials.validations_errors')
    @include('flash::message')

    <!--================Home Banner Area =================-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="#">
                <img class="d-block w-100" src="{{Storage::url(settings()->image_wow_souq)}}" alt="First slide">
                </a>
{{--                <div class="carousel-caption d-none d-md-block" style="">--}}
{{--                    <h5>Shopping</h5>--}}
{{--                    <p>Shopping</p>--}}
{{--                </div>--}}
            </div>
            <div class="carousel-item">
                <a href="#">
                <img class="d-block w-100" src="{{Storage::url(settings()->image_wow_souq)}}" alt="Second slide">
                </a>
{{--                <div class="carousel-caption d-none d-md-block">--}}
{{--                    <h5>Shopping</h5>--}}
{{--                    <p>Shopping</p>--}}
{{--                </div>--}}
            </div>
            <div class="carousel-item">
                <a href="#">
                <img class="d-block w-100" src="{{Storage::url(settings()->image_wow_souq)}}" alt="Third slide">
                </a>
{{--                <div class="carousel-caption d-none d-md-block">--}}
{{--                    <h5>Shopping</h5>--}}
{{--                    <p>Shopping</p>--}}
{{--                </div>--}}
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--================End Home Banner Area =================-->

    <!--================ Feature Product Area =================-->
    <section class="feature_product_area section_gap_bottom_custom" style="margin-top: 100px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Featured product</span></h2>
                        <p>Bring called seed first of third give itself now ment</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($top_product as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" style="width: 100%;height: 300px;"
                                     src="{{Storage::url($product->image)}}" alt=""/>
                                <div class="p_icon">
                                    <a href="{{url('product',$product->id)}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="#" class="like">
                                        <i class="ti-heart"></i>
                                    </a>

                                    <a href="{{ route('client.getAddToCart', ['id' => $product->id]) }}">
                                        <i class="ti-shopping-cart"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="#" class="d-block">
                                    <h4>{{$product->name}}</h4>
                                </a>
                                <div class="mt-3">
                                    <span class="mr-4">{{$product->price}} {{trans('web.EGP')}}</span>
                                    @if ($product->offer != null)
                                        <del>{{$product->offer}} {{trans('web.EGP')}}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--================ End Feature Product Area =================-->

    {{--    <!--================ Offer Area =================-->--}}
    {{--    <section class="offer_area">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row justify-content-center">--}}
    {{--                <div class="offset-lg-4 col-lg-6 text-center">--}}
    {{--                    <div class="offer_content">--}}
    {{--                        <h3 class="text-uppercase mb-40">all men’s collection</h3>--}}
    {{--                        <h2 class="text-uppercase">50% off</h2>--}}
    {{--                        <a href="#" class="main_btn mb-20 mt-5">Discover Now</a>--}}
    {{--                        <p>Limited Time Offer</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!--================ End Offer Area =================-->--}}

    <!--================ New Product Area =================-->
    <section class="new_product_area section_gap_top section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>new products</span></h2>
                        <p>Bring called seed first of third give itself now ment</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="new_product">
                        <h5 class="text-uppercase">collection of 2019</h5>
                        <h3 class="text-uppercase">Men’s summer t-shirt</h3>
                        <div class="product-img">
                            <img class="img-fluid" src="{{asset('wow_souq')}}/img/product/new-product/new-product1.png"
                                 alt=""/>
                        </div>
                        <h4>$120.70</h4>
                        <a href="#" class="main_btn">Add to cart</a>
                    </div>
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="img-fluid w-100"
                                         src="{{asset('wow_souq')}}/img/product/new-product/n1.jpg" alt=""/>
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>Nike latest sneaker</h4>
                                    </a>
                                    <div class="mt-3">
                                        <span class="mr-4">$25.00</span>
                                        <del>$35.00</del>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="img-fluid w-100"
                                         src="{{asset('wow_souq')}}/img/product/new-product/n2.jpg" alt=""/>
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>Men’s denim jeans</h4>
                                    </a>
                                    <div class="mt-3">
                                        <span class="mr-4">$25.00</span>
                                        <del>$35.00</del>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="img-fluid w-100"
                                         src="{{asset('wow_souq')}}/img/product/new-product/n3.jpg" alt=""/>
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>quartz hand watch</h4>
                                    </a>
                                    <div class="mt-3">
                                        <span class="mr-4">$25.00</span>
                                        <del>$35.00</del>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="img-fluid w-100"
                                         src="{{asset('wow_souq/img/product/new-product/n4.jpg')}}" alt=""/>
                                    <div class="p_icon">
                                        <a href="#">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a href="#">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>adidas sport shoe</h4>
                                    </a>
                                    <div class="mt-3">
                                        <span class="mr-4">$25.00</span>
                                        <del>$35.00</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End New Product Area =================-->

    <!--================ Inspired Product Area =================-->
    <section class="inspired_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Inspired products</span></h2>
                        <p>Bring called seed first of third give itself now ment</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i1.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i2.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i3.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i4.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i6.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i7.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i8.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                <a href="#">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Inspired Product Area =================-->


    <!--================ Inspired Product Area =================-->
    <section class="inspired_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Inspired products</span></h2>
                        <p>Bring called seed first of third give itself now ment</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i1.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i2.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i3.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i4.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i5.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i6.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i7.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('wow_souq/img/product/inspired-product/i8.jpg')}}"
                                 alt=""/>
                            <div class="p_icon">
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-eye"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#">--}}
                                {{--                                    <i class="ti-heart"></i>--}}
                                {{--                                </a>--}}
                                <a href="#">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="#" class="d-block">
                                <h4>Latest men’s sneaker</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Inspired Product Area =================-->

@endsection
