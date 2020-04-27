@extends('admin.layouts.app')
@inject('model', 'App\Model\Ad')
@section('page_title')
    {{trans('admin.adCreate')}}
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
                <h3 class="box-title">{{trans('admin.adCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, ['action' => 'Admin\AdController@store', 'files' => true]) !!}

                        <div class="form-group">
                            <label for="time_start">{{trans('admin.time_start')}}</label>
                            {!! Form::date('time_start', null , ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="time_finish">{{trans('admin.time_finish')}}</label>
                            {!! Form::date('time_finish', null , ['class' => 'form-control']) !!}
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
