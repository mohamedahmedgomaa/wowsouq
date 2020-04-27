@extends('wow_souq.layouts.app')

@section('wow_souq')

    @include('partials.validations_errors')
    @include('flash::message')

    <!--================Home Banner Area =================-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            @php
                $i = 0;
            @endphp
            @foreach($ad_s as $ad)
                @php
                    $i = $i + 1;
                @endphp
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <a href="{{url('product',$ad_ad->product_id)}}">
                    <img class="d-block w-100" src="{{ Storage::url($ad_ad->image) }}" alt="First slide"
                         style="min-height: 698px">
                </a>
            </div>
            @foreach($ad_s as $ad)
                <div class="carousel-item">
                    <a href="{{url('product',$ad->product_id)}}">
                        <img class="d-block w-100" src="{{ Storage::url($ad->image) }}" alt="Second slide"
                             style="min-height: 698px">
                    </a>
                </div>
            @endforeach
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
                        <h5 class="text-uppercase">{{$firstNewProductIndex->name}}</h5>
                        <div class="product-img" style="width: 510px;height: 365px;">
                            <img class="img-fluid" src="{{Storage::url($product->image)}}"
                                 style="width: 510px;height: 200px;"
                                 alt=""/>
                        </div>
                        <h4><span class="mr-4">{{$firstNewProductIndex->price}} {{trans('web.EGP')}}</span></h4>
                        @if ($firstNewProductIndex->offer != null)
                            <h4>
                                <del>{{$firstNewProductIndex->offer}} {{trans('web.EGP')}}</del>
                            </h4>
                        @endif
                        <a href="{{ route('client.getAddToCart', ['id' => $firstNewProductIndex->id]) }}"
                           class="main_btn">Add to
                            cart</a>
                    </div>
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row">
                        @foreach($newProductIndex as $product)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-product">
                                    <div class="product-img">
                                        <img class="img-fluid w-100" style="height: 254px;"
                                             src="{{Storage::url($product->image)}}" alt=""/>
                                        <div class="p_icon">
                                            <a href="{{url('product',$product->id)}}">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a href="#">
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
                @foreach($oldProductIndex as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" style="width: 100%;height: 300px;"
                                     src="{{Storage::url($product->image)}}" alt=""/>
                                <div class="p_icon">
                                    <a href="{{url('product',$product->id)}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="#">
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
    <!--================ End Inspired Product Area =================-->


    <!--================ Inspired Product Area =================-->
    @if ($categoriesAllIndex->count() != 0)
        <section class="inspired_product_area section_gap_bottom_custom">
        @foreach($categoriesAllIndex as $category)
            @if ($category->products->count() != 0)
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="main_title">
                                    @if (session('lang') === 'en')
                                        <h2><span>{{trans('web.Category is')}} : {{$category->name_en}}</span></h2>
                                    @else
                                        <h2><span>{{trans('web.Category is')}} : {{$category->name_ar}}</span></h2>
                                    @endif
                                    @if (session('lang') === 'en')
                                        <p>{{ $category->description_en }}</p>
                                    @else
                                        <p>{{ $category->description_ar }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($category->products as $product)
                                <div class="col-lg-2 col-md-6">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <img class="img-fluid w-100" style="height: 160px;"
                                                 src="{{Storage::url($product->image)}}"
                                                 alt=""/>
                                            <div class="p_icon">
                                                <a href="{{ route('client.getAddToCart', ['id' => $product->id]) }}">
                                                    <i class="ti-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-btm">
                                            <a href="{{url('product',$product->id)}}" class="d-block">
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
                    @else
                    @endif
                    @endforeach
                </section>

    @else
    @endif
    <!--================ End Inspired Product Area =================-->

@endsection
