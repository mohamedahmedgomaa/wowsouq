@extends('admin.layouts.app')
@inject('model', 'App\Model\Client')
@section('page_title')
    {{trans('admin.clientCreate')}}
@endsection
@section('small_title')
    {{trans('admin.client')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.clientCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, ['action' => 'Admin\ClientController@store', 'files' => true]) !!}
                        @include('admin.clients.form')
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
