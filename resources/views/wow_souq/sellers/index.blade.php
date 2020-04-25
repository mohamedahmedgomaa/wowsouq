@extends('wow_souq.layouts.app')

@section('wow_souq')


    <section class="feature_product_area section_gap_bottom_custom">
        <div class="container">
            @include('partials.validations_errors')
            @include('flash::message')
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>{{trans('web.Your product')}}</span></h2>
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
                                    <a href="{{url('product',$product->id)}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{url('seller/product/edit', $product->id)}}">
                                        <i class="ti fa fa-edit"></i>
                                    </a>
                                    <a  data-toggle="modal" data-target="#del_product{{ $product->id }}">
                                        <i class="ti fa fa-trash"></i>
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

                @endforeach

            </div>
        </div>
    </section>



@endsection
