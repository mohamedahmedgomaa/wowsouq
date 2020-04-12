@extends('admin.layouts.app')
{{--@inject('client', 'App\Model\Client')--}}
{{--@inject('user', 'App\User')--}}
{{--@inject('neighborhood', 'App\Model\Neighborhood')--}}
{{--@inject('city', 'App\Model\City')--}}
{{--@inject('category', 'App\Model\Category')--}}
{{--@inject('contacts', 'App\Model\Contact')--}}
{{--@inject('order', 'App\Model\Order')--}}
{{--@inject('offer', 'App\Model\Offer')--}}
{{--@inject('restaurant', 'App\Model\Restaurant')--}}
@section('page_title')
    {{trans('admin.dashboard')}}
@endsection
@section('small_title')
    {{trans('admin.statistics')}}
@endsection
@section('content')


    <!-- Main content -->
    <section class="content">

{{--        <!-- Info boxes -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-aqua"><i class="fa fa-cutlery"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.restaurantCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$restaurant->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.orderCompleteCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$order->where('state', 'declined')->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.usersCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$user->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}

{{--            <!-- fix for small devices only -->--}}
{{--            <div class="clearfix visible-sm-block"></div>--}}

{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-aqua"><i class="fa fa-list-ol"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.offerCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$offer->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-red"><i class="fa fa-envelope"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.contactCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$contacts->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--            <div class="col-md-4 col-sm-4 col-xs-12">--}}
{{--                <div class="info-box">--}}
{{--                    <span class="info-box-icon bg-green"><i class="fa fa-building-o"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('admin.neighborhoodCount')}}</span>--}}
{{--                        <span class="info-box-number">{{$neighborhood->count()}}</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}

{{--            <!-- fix for small devices only -->--}}
{{--            <div class="clearfix visible-sm-block"></div>--}}

{{--        </div>--}}
{{--        <!-- /.row -->--}}

    </section>
@endsection
