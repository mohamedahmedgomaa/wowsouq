@extends('wow_souq.layouts.app')

@section('wow_souq')
    @include('partials.validations_errors')
    @include('flash::message')
    <section class="home_banner_area mb-40"
             style="background-image: url('{{Storage::url(settings()->image_product)}}'); margin-bottom: 0;background-size: cover;">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="border border-dark"
                     style="margin-top: 50px;margin-bottom: 50px;margin-left: 33%;padding-top: 30px;padding-bottom: 40px;padding-left: 50px;width: 450px;background-color: rgba(0,0,0,0.7);border-radius: 20px">

                    <div class="text-center" style="margin: 0">
                        <h2 style="color: #ffffff;margin-right: 30px">{{trans('web.productCreate')}}</h2>
                    </div>

                    <form method="post" action="{{ route('wowsouq.seller.product.update',$product->id) }}"
                          enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <style>
                            .nice-select {
                                width: 100%;
                            }

                            .nice-select .option {
                                width: 325px;
                            }
                        </style>

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div>
                                    <label for="category_id" style="color: #ffffff"
                                           class="col-form-label">{{trans('web.category')}}</label>
                                </div>
                                <select name="category_id" id="category_id" required style="width: 100%">
                                    <option value="0">{{trans('web.no_data')}}</option>
                                    @foreach($category as $index)
                                        <option
                                            value="{{$index->id}}" {{$index->id == $product->category_id ? 'selected' : ''}}>{{$index->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.name')}}</label>
                                    <input type="text" name="name" value="{{$product->name}}"
                                           placeholder="{{trans('web.name')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.name')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <div class="banner_content row">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="description"
                                           style="color: #ffffff">{{trans('web.description')}}</label>
                                    <textarea id="description" name="description" maxlength="1900"
                                              class="single-input-accent" rows="4"
                                              placeholder="{{trans('web.description')}}"
                                              onfocus="this.placeholder = ''"
                                              onblur="this.placeholder = '{{trans('web.description')}}'"
                                              required>{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.price')}}</label>
                                    <input type="text" name="price" value="{{$product->price}}"
                                           placeholder="{{trans('web.price')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.price')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="offer" style="color: #ffffff">{{trans('web.offer')}}</label>
                                    <input type="text" name="offer" value="{{$product->offer}}"
                                           placeholder="{{trans('web.offer')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.offer')}}'"
                                           class="single-input-accent">
                                </div>
                            </div>
                        </div>


                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label style="color: #ffffff">{{trans('web.number_product')}}</label>
                                    <input type="number" name="number_product" value="{{$product->number_product}}"
                                           placeholder="{{trans('web.number_product')}}"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{trans('web.number_product')}}'"
                                           required class="single-input-accent">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="image" style="color: #ffffff">{{trans('web.image')}}</label>
                                    <input type="file" style="color: #ffffff" class="form-control-file"
                                           name="image">
                                    <img src="{{Storage::url($product->image)}}" alt="000000" class="img-thumbnail"
                                         style="width: 100px;height: 100px;margin-top: 10px">
                                </div>
                            </div>
                        </div>

                        <div class="banner_content row" style="margin-top: 10px">
                            <div class="col-lg-10">
                                <div class="mt-10">
                                    <label for="files" style="color: #ffffff">{{trans('web.files')}}</label>
                                    <input type="file" style="color: #ffffff" class="form-control-file"
                                           name="files[]" multiple="multiple">
                                    @foreach($product->files as $file)
                                        <label>
                                            <img src="{{Storage::url($file->file)}}" alt="000000"
                                                 class="img-thumbnail"
                                                 style="width: 50px;height: 50px;margin: 10px 0 20px 10px">
                                            <input type="checkbox" name="file_id[]" value="{{$file->id}}">
                                        </label>
                                    @endforeach
                                    <div class="clearfix"></div>
                                    @if ($product->files->count() != 0)
                                        {!! Form::submit(trans('web.delete photo'), ['class' => 'btn btn-danger', 'name' => 'delete_photo']) !!}
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-10" style="margin-top: 30px;font-size: large;">
                            <button type="submit"
                                    class="genric-btn primary-border circle form-control">{{trans('web.send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

@endsection
