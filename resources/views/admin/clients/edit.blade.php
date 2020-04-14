@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.clientEdit')}}
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
            <h3 class="box-title">{{trans('admin.clientEdit')}}</h3>
        </div>
        <div class="box-body">
            <div class="box">
                @include('flash::message')
                @include('partials.validations_errors')
                <div class="box-body">
                    {!! Form::model($model, [
                        'action' => ['Admin\ClientController@update',$model->id],
                        'method' =>'put',
                        'files' =>true,
                    ]) !!}
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
