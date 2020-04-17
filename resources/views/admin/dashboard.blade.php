@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.statistics')}}
@endsection
@section('small_title')
    {{trans('admin.dashboard')}}
@endsection
@section('content')


    <!-- Main content -->
    <section class="content">

        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.categories')}}</span>
                        <span class="info-box-number">{{$categories}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.clientss')}}</span>
                        <span class="info-box-number">{{$clients}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-user-secret"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.admins')}}</span>
                        <span class="info-box-number">{{$users}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

        </div>


        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-heart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.likes')}}</span>
                        <span class="info-box-number">{{$likes}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-product-hunt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.products')}}</span>
                        <span class="info-box-number">{{$products}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.sellerss')}}</span>
                        <span class="info-box-number">{{$sellers}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-comments"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.comments')}}</span>
                        <span class="info-box-number">{{$comments}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-first-order"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.orders')}}</span>
                        <span class="info-box-number">{{$orders}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-bar-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.orders_new')}}</span>
                        <span class="info-box-number">{{$orders_new}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

        </div>
        <!-- /.row -->



        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-area-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.orders_current')}}</span>
                        <span class="info-box-number">{{$orders_current}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.orders_old')}}</span>
                        <span class="info-box-number">{{$orders_old}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-green"><i class="fa fa-address-card"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.orders_new')}}</span>--}}
{{--                        <span class="info-box-number">{{$orders_new}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

        </div>
        <!-- /.row -->

    </section>
@endsection
