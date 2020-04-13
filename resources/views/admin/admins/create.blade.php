@extends('admin.layouts.app')
@inject('model', 'App\User')
@section('content')
@section('page_title')
    {{trans('admin.adminCreate')}}
@endsection
@section('small_title')
    {{trans('admin.admin')}}
@endsection

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.adminCreate')}}</h3>
        </div>
        <div class="box-body">
            <div class="box">
                @include('partials.validations_errors')
                <div class="box-body">
                    {!! Form::model($model, ['action' => 'Admin\AdminController@store']) !!}
                    @include('admin.admins.form')
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
