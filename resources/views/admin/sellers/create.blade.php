@extends('admin.layouts.app')
@inject('model', 'App\Model\Seller')
@section('page_title')
    {{trans('admin.sellerCreate')}}
@endsection
@section('small_title')
    {{trans('admin.seller')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.sellerCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, ['action' => 'Admin\SellerController@store', 'files' => true]) !!}
                        @include('admin.sellers.form')
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
