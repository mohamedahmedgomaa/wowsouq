@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.settings')}}
@endsection
@section('small_title')
    {{trans('admin.setting')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.setting')}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('flash::message')
                    @include('partials.validations_errors')
                    <div class="box-body">
                        <form action="{{route('settings.update')}}" method="POST"  enctype="multipart/form-data">
                            {{ csrf_field()}}
                            <div class="form-group">
                                <label for="phone">{{trans('admin.phone')}}</label>
                                <input type="text" class="form-control" name="phone"  value="{{$settings->phone}}">
                            </div>

                            <div class="form-group">
                                <label for="blog_email">{{trans('admin.email')}}</label>
                                <input type="text" class="form-control" name="email"  value="{{$settings->email}}">
                            </div>


                            <div class="form-group">
                                <label for="image">{{trans('admin.logo')}}</label>
                                <input type="file" class="form-control-file" name="image">
                                <img src="{{Storage::url($settings->image)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="delivery">{{trans('admin.delivery')}}</label>
                                <input type="text" class="form-control" name="delivery"  value="{{$settings->delivery}}">
                            </div>

                            <div class="form-group">
                                <label for="text">{{trans('admin.text')}}</label>
                                <textarea name="text" class="form-control" rows="8">{{$settings->text}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contents">{{trans('admin.contents')}}</label>
{{--                                <input type="text" class="form-control" name="text"  value="{{$settings->contents}}">--}}
                                <textarea name="contents" class="form-control" rows="8">{{$settings->contents}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="image_wow_souq">{{trans('admin.image_wow_souq')}}</label>
                                <input type="file" class="form-control-file" name="image_wow_souq">
                                <img src="{{Storage::url($settings->image_wow_souq)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>


                            <div class="form-group">
                                <label for="image_login_client">{{trans('admin.image_login_client')}}</label>
                                <input type="file" class="form-control-file" name="image_login_client">
                                <img src="{{Storage::url($settings->image_login_client)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>


                            <div class="form-group">
                                <label for="image_register_client">{{trans('admin.image_register_client')}}</label>
                                <input type="file" class="form-control-file" name="image_register_client">
                                <img src="{{Storage::url($settings->image_register_client)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_login_seller">{{trans('admin.image_login_seller')}}</label>
                                <input type="file" class="form-control-file" name="image_login_seller">
                                <img src="{{Storage::url($settings->image_login_seller)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_register_seller">{{trans('admin.image_register_seller')}}</label>
                                <input type="file" class="form-control-file" name="image_register_seller">
                                <img src="{{Storage::url($settings->image_register_seller)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_login_admin">{{trans('admin.image_login_admin')}}</label>
                                <input type="file" class="form-control-file" name="image_login_admin">
                                <img src="{{Storage::url($settings->image_login_admin)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_product">{{trans('admin.image_product')}}</label>
                                <input type="file" class="form-control-file" name="image_product">
                                <img src="{{Storage::url($settings->image_product)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_profile_client">{{trans('admin.image_profile_client')}}</label>
                                <input type="file" class="form-control-file" name="image_profile_client">
                                <img src="{{Storage::url($settings->image_profile_client)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="image_profile_seller">{{trans('admin.image_profile_seller')}}</label>
                                <input type="file" class="form-control-file" name="image_profile_seller">
                                <img src="{{Storage::url($settings->image_profile_seller)}}" alt="000000" class="img-thumbnail"
                                     width="100px" height="100px">
                            </div>

                            <div class="form-group">
                                <label for="whats_app">{{trans('admin.whats_app')}}</label>
                                <input type="text" class="form-control" name="whats_app"  value="{{$settings->whats_app}}">
                            </div>

                            <div class="form-group">
                                <label for="instagram">{{trans('admin.instagram')}}</label>
                                <input type="text" class="form-control" name="instagram"  value="{{$settings->instagram}}">
                            </div>

                            <div class="form-group">
                                <label for="you_tube">{{trans('admin.you_tube')}}</label>
                                <input type="text" class="form-control" name="you_tube"  value="{{$settings->you_tube}}">
                            </div>

                            <div class="form-group">
                                <label for="facebook">{{trans('admin.facebook')}}</label>
                                <input type="text" class="form-control" name="facebook"  value="{{$settings->facebook}}">
                            </div>


                            <button type="submit" class="btn btn-primary btn-lg">تعديل</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
