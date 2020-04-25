@extends('wow_souq.layouts.app')

@section('wow_souq')

    <style>
        .second-test {
            color: #e41e25;
            font-size: 48px;
            position: absolute;
            left: .5rem;
            top: .8rem;


        }

        .second-heart {

            color: #d81c23;
            font-size: 48px;
            position: absolute;
            left: .5rem;
            top: .8rem;
        }
    </style>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                @include('partials.validations_errors')
                @include('flash::message')
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Product Details</h2>
                    </div>
                    <div class="page_link">
                        <a href="{{url('/')}}">Home</a>
                        <a href="#">Product Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_product_img">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                    <img src="{{Storage::url($product->image)}}" style="width: 60px;height: 60px"
                                         alt=""/>
                                </li>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($product->files as $file)
                                @php

                                    $i = 0 + 1;
                                @endphp
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}">
                                    <img src="{{Storage::url($file->file)}}"
                                         alt="" style="width: 60px;height: 60px"/>
                                </li>
                                @endforeach
{{--                                <li data-target="#carouselExampleIndicators" data-slide-to="2">--}}
{{--                                    <img src="{{asset('wow_souq')}}/img/product/single-product/s-product-s-4.jpg"--}}
{{--                                         alt=""/>--}}
{{--                                </li>--}}
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img
                                        class="d-block w-100" style="height: 584px;width: 540px;"
                                        src="{{Storage::url($product->image)}}"
                                        alt="First slide"/>
                                </div>
                                @foreach($product->files as $file)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{Storage::url($file->file)}}" alt="{{$file->id}}"  style="height: 584px;width: 540px;"/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{$product->name}}</h3>
                        <h2>{{$product->price}} {{trans('web.EGP')}}</h2>
                        @if ($product->offer != null)
                            <del>{{$product->offer}} {{trans('web.EGP')}}</del>
                        @endif
                        <ul class="list">
                            <li>
                                @if (session('lang') === 'en')
                                    <a class="active" href="#">
                                        <span>Category</span> : {{$product->category->name_en}}
                                    </a>
                                @else
                                    <a class="active" href="#">
                                        <span>Category</span> : {{$product->category->name_ar}}
                                    </a>
                                @endif
                            </li>
                            {{--                        <li>--}}
                            {{--                            <a href="#"> <span>Availibility</span> : In Stock</a>--}}
                            {{--                        </li>--}}
                        </ul>
                        <p>
                            {{$product->description}}
                        </p>
                        <div class="card_area">
                            <a class="main_btn" href="{{ route('client.getAddToCart', ['id' => $product->id]) }}">Add to
                                Cart</a>
                            <a class="icon_btn" href="#">
                                <i class="lnr lnr lnr-heart"></i>
                            </a>
                            <div class="product" data-postid="{{ $product->id }}">
                                <div class="interaction">
                                    @if (auth('clients')->user() != null)
                                        <a href="#"
                                           class="btn btn-xs btn-warning like">{{ auth('clients')->user()->likes()->where('product_id', $product->id)->first() ? auth('clients')->user()->likes()->where('product_id', $product->id)->first()->like == 1 ? 'You like this product' : 'Like' : 'Like'  }}</a>
                                        |
                                        <a href="#"
                                           class="btn btn-xs btn-danger like">{{ auth('clients')->user()->likes()->where('product_id', $product->id)->first() ? auth('clients')->user()->likes()->where('product_id', $product->id)->first()->like == 0 ? 'You dont like this product' : 'Dislike' : 'Dislike'  }}</a>
                                    @endif
                                    {{--                                        <i class="fa fa-gratipay--}}
                                    {{--                                {{$product->is_favourite ? 'second-heart' : 'first-heart'}}--}}
                                    {{--                                            " id="{{$product->id}}" onclick="toggleFavourite(this)"></i>--}}
                                </div>
                            </div>
                            @if (auth('sellers')->user() != null && auth('sellers')->user()->id == $product->seller_id)
                                <a class="icon_btn" href="{{url('seller/product/edit', $product->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="icon_btn" data-toggle="modal" data-target="#del_product{{ $product->id }}">
                                    <i class="lnr lnr lnr-trash"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    <!-- Modal -->
    <div id="del_product{{ $product->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                {!! Form::open(['route'=>['wowsouq.seller.product.delete',$product->id], 'method'=>'delete']) !!}
                <div class="modal-body">
                    <h4>{{ trans('admin.delete_this',['name'=>$product->name]) }}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
                    {!! Form::submit(trans('admin.yes'), ['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>



    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="home-tab"
                        data-toggle="tab"
                        href="#home"
                        role="tab"
                        aria-controls="home"
                        aria-selected="true"
                    >Description</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="contact-tab"
                        data-toggle="tab"
                        href="#contact"
                        role="tab"
                        aria-controls="contact"
                        aria-selected="false">Comments</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link active"
                        id="review-tab"
                        data-toggle="tab"
                        href="#review"
                        role="tab"
                        aria-controls="review"
                        aria-selected="false"
                    >Reviews</a
                    >
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div
                    class="tab-pane fade"
                    id="home"
                    role="tabpanel"
                    aria-labelledby="home-tab"
                >
                    <p>
                     {{$product->description}}
                    </p>
                </div>
                <div
                    class="tab-pane fade"
                    id="contact"
                    role="tabpanel"
                    aria-labelledby="contact-tab"
                >

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="comment_list">
                                @if ($product->comments->count() != 0)
                                    @foreach($product->comments as $comment)
                                        <div class="review_item">
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{Storage::url($comment->client->image)}}"
                                                         style="width: 70px;border-radius: 50%;height: 71px;" alt=""/>
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{$comment->client->name}}</h4>
                                                    <h5>{{$comment->created_at}}</h5>
                                                    {{--                                                    <a class="reply_btn" href="#">Reply</a>--}}
                                                </div>
                                            </div>
                                            <p>
                                                {{$comment->comment}}
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex btn btn-danger">
                                                {{trans('web.No Comment')}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{--                                <div class="review_item reply">--}}
                                {{--                                    <div class="media">--}}
                                {{--                                        <div class="d-flex">--}}
                                {{--                                            <img--}}
                                {{--                                                src="{{asset('wow_souq')}}/img/product/single-product/review-2.png"--}}
                                {{--                                                alt=""--}}
                                {{--                                            />--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="media-body">--}}
                                {{--                                            <h4>Blake Ruiz</h4>--}}
                                {{--                                            <h5>12th Feb, 2017 at 05:56 pm</h5>--}}
                                {{--                                            <a class="reply_btn" href="#">Reply</a>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <p>--}}
                                {{--                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
                                {{--                                        sed do eiusmod tempor incididunt ut labore et dolore magna--}}
                                {{--                                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation--}}
                                {{--                                        ullamco laboris nisi ut aliquip ex ea commodo--}}
                                {{--                                    </p>--}}
                                {{--                                </div>--}}

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Post a comment Form</h4>
                                <form class="row contact_form"
                                      action="{{route('wowsouq.client.comments',$product->id)}}" method="POST"
                                      id="contactForm" novalidate="novalidate">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" id="comment" rows="7" required
                                                      placeholder="{{trans('web.comment')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        @if (auth('clients')->user() != null)
                                            <button type="submit"
                                                    class="btn submit_btn">{{trans('web.submit')}}</button>
                                        @else
                                            <a href="{{url('client/login')}}"
                                               class="btn submit_btn">{{trans('web.submit')}}</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <div
                    class="tab-pane fade show active"
                    id="review"
                    role="tabpanel"
                    aria-labelledby="review-tab"
                >
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>{{trans('web.overall')}}</h5>
                                        <h4>{{ number_format($product->reviews->avg('rate'),2) }}</h4>
                                        <h6>({{$product->reviews->count()}} {{trans('web.reviews')}})</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on 5 Reviews</h3>
                                        <ul class="list">
                                            @foreach($product->reviews->take(5) as $review)
                                                <li><a href="#">{{$review->rate}} Star
                                                        @for($i= 1; $i <= 5;$i++)
                                                            <i class="fa fa-star{{$review->rate >= $i?'':'-o'}}"></i>
                                                        @endfor
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @foreach($product->reviews as $review)
                                <div class="review_list" style="margin-top: 20px">
                                    <div class="review_item">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img
                                                    src="{{Storage::url($review->client->image)}}" style="width: 70px;border-radius: 50%;height: 71px;"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="media-body">
                                                <h4>{{$review->client->name}}</h4>
                                                @for($i= 1; $i <= 5;$i++)
                                                    <i class="fa fa-star{{$review->rate >= $i?'':'-o'}}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p>
                                            {{ $review->review }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>

                                <form class="row contact_form" action="{{route('wowsouq.client.reviews', $product->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p>Your Rating:</p>

                                            <div class="rating">
                                                <input type="radio" name="rate"  value="5" id="rate1"><label for="rate1"></label>
                                                <input type="radio" name="rate"  value="4" id="rate2"><label for="rate2"></label>
                                                <input type="radio" name="rate"  value="3" id="rate3"><label for="rate3"></label>
                                                <input type="radio" name="rate"  value="2" id="rate4"><label for="rate4"></label>
                                                <input type="radio" name="rate"  value="1" id="rate5"><label for="rate5"></label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="review" id="review" rows="6"
                                                      placeholder="{{trans('web.review')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="btn submit_btn">
                                            {{trans('web.submit')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->
@endsection

@push('js')
{{--    <script>--}}

{{--        var token = '{{ Session::token() }}';--}}
{{--        var urlLike = '{{ route('like') }}';--}}
{{--    </script>--}}
<script>
    $("#input-3").rating();
</script>
@endpush
