@extends('wow_souq.layouts.app')

@section('wow_souq')


    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        @if (session('lang') === 'en')
                            <h2>{{$category->name_en}}</h2>
                        @else
                            <h2>{{$category->name_ar}}</h2>
                        @endif
                        @if (session('lang') === 'en')
                            <p>{{$category->description_en}}</p>
                        @else
                            <p>{{$category->description_ar}}</p>
                        @endif
                    </div>
                    <div class="page_link">
                        <a href="{{url('/')}}">{{trans('web.home')}}</a>
                        @if (session('lang') === 'en')
                            <a>{{$category->name_en}}</a>
                        @else
                            <a>{{$category->name_ar}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    @if ($products->links() != '')
                        <div class="product_top_bar">
                            <div class="text-center">{{$products->links()}}</div>
                        </div>
                    @endif

                    <div class="latest_product_inner">
                        <div class="row">
                            @if ($products->count() != 0)
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <img
                                                    class="card-img"
                                                    src="{{Storage::url($product->image)}}"
                                                    alt="" style="width: 100%;height: 300px;"/>
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
                                                    <span class="mr-4">{{$product->price}}{{trans('web.EGP')}}</span>
                                                    <del>{{$product->offer}}{{trans('web.EGP')}}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-12 col-md-12">
                                    <div class="text-center alert alert-danger"
                                         style="width: 100%">{{trans('web.No Product in The Category')}}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($products->links() != '')
                        <div class="product_top_bar" style="margin-top: 20px">
                            <div class="text-center">{{$products->links()}}</div>
                        </div>
                    @endif

                </div>

                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach($category_all as $category)
                                        <li>
                                            @if (session('lang') === 'en')
                                                <a href="{{url('category', $category->id)}}">{{$category->name_en}}</a>
                                            @else
                                                <a href="{{url('category', $category->id)}}">{{$category->name_ar}}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        {{--                        <aside class="left_widgets p_filter_widgets">--}}
                        {{--                            <div class="l_w_title">--}}
                        {{--                                <h3>Product Brand</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="widgets_inner">--}}
                        {{--                                <ul class="list">--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Apple</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Asus</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="active">--}}
                        {{--                                        <a href="#">Gionee</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Micromax</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Samsung</a>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </aside>--}}

                        {{--                        <aside class="left_widgets p_filter_widgets">--}}
                        {{--                            <div class="l_w_title">--}}
                        {{--                                <h3>Color Filter</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="widgets_inner">--}}
                        {{--                                <ul class="list">--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Black</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Black Leather</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="active">--}}
                        {{--                                        <a href="#">Black with red</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Gold</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li>--}}
                        {{--                                        <a href="#">Spacegrey</a>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        </aside>--}}

                        {{--                        <aside class="left_widgets p_filter_widgets">--}}
                        {{--                            <div class="l_w_title">--}}
                        {{--                                <h3>Price Filter</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="widgets_inner">--}}
                        {{--                                <div class="range_item">--}}
                        {{--                                    <div id="slider-range"></div>--}}
                        {{--                                    <div class="">--}}
                        {{--                                        <label for="amount">Price : </label>--}}
                        {{--                                        <input type="text" id="amount" readonly/>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </aside>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->


@endsection
