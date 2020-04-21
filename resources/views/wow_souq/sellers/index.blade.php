@extends('wow_souq.layouts.app')

@section('wow_souq')

    <section class="feature_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>Your product</span></h2>
                        <a href="{{url('seller/product/create')}}" class="genric-btn primary circle" style="width: 300px;font-size: 20px">{{trans('web.add_new_product')}}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach(auth('sellers')->user()->products as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" style="width: 100%;height: 300px;"
                                     src="{{Storage::url($product->image)}}" alt=""/>
                                <div class="p_icon">
                                    <a href="#">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="#" class="d-block">
                                    <h4>{{$product->name}}</h4>
                                </a>
                                <div class="mt-3">
                                    <span class="mr-4">${{$product->price}}</span>
                                    <del>${{$product->offer}}</del>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
