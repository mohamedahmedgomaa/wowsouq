@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.adEdit')}}
@endsection
@section('small_title')
    {{trans('admin.ad')}}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.adEdit')}}</h3>
        </div>
        <div class="box-body">
            <div class="box">
                @include('flash::message')
                @include('partials.validations_errors')
                <div class="box-body">
                    {!! Form::model($model, [
                        'action' => ['Admin\AdController@update',$model->id],
                        'method' =>'put',
                        'files' =>true,
                    ]) !!}

                    <div class="form-group">
                        <label for="time_start">{{trans('admin.time_start')}}</label>
                        {!! Form::text('time_start', null , ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="time_finish">{{trans('admin.time_finish')}}</label>
                        {!! Form::text('time_finish', null , ['class' => 'form-control']) !!}
                    </div>

                    @include('admin.ads.form')
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
