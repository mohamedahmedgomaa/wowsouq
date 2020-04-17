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

                    <div class="form-group">
                        <label for="roles">قائمه الرتب</label>
                        {!! Form::select('roles[]',$roles,null, [
                        'class'=>'form-control select2',
                        'multiple' => 'multiple'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
                    </div>
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
