@extends('wow_souq.layouts.app')

@section('wow_souq')
    <!--================Home Banner Area =================-->
    <section class="banner_area" style="margin-bottom: 50px">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>{{trans('web.likeClient')}}</h2>
                        <p>{{trans('web.likeClientParagraph')}}</p>
                    </div>
                    <div class="page_link">
                        <a href="{{url('/')}}">{{trans('web.home')}}</a>
                        <a>{{trans('web.likeClient')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->


    <section class="feature_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row">
                @foreach(auth('clients')->user()->likes as $like)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" style="width: 100%;height: 300px;"
                                     src="{{Storage::url($like->product['image'])}}" alt=""/>
                                <div class="p_icon">
                                    <a href="{{url('product',$like->product['id'])}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="#" class="like">
                                        <i class="ti-heart"></i>
                                    </a>

                                    <a href="{{ route('client.getAddToCart', ['id' => $like->product['id']]) }}">
                                        <i class="ti-shopping-cart"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="#" class="d-block">
                                    <h4>{{$like->product['name']}}</h4>
                                </a>
                                <div class="mt-3">
                                    <span class="mr-4">{{$like->product['price']}} {{trans('web.EGP')}}</span>
                                    @if ($like->product['offer'] != null)
                                        <del>{{$like->product['offer']}} {{trans('web.EGP')}}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
