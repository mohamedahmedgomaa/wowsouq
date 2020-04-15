@extends('admin.layouts.app')
@inject('model', 'App\Model\Category')
@section('page_title')
    {{trans('admin.paymentMethodCreate')}}
@endsection
@section('small_title')
    {{trans('admin.paymentMethod')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.paymentMethodCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, ['action' => 'Admin\PaymentMethodController@store']) !!}
                        @include('admin.payment_methods.form')
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
