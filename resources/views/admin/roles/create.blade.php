@extends('admin.layouts.app')
@inject('model', 'Spatie\Permission\Models\Role')
@section('page_title')
    {{trans('admin.roleCreate')}}
@endsection
@section('small_title')
    {{trans('admin.role')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.roleCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, ['action' => 'Admin\RoleController@store']) !!}
                        @include('admin.roles.form')

{{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <strong>Permission:</strong>--}}
{{--                                <br/>--}}
{{--                                @foreach($permission as $value)--}}
{{--                                    <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}--}}
{{--                                        {{ $value->name }}</label>--}}
{{--                                    <br/>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="roles">{{trans('admin.permissions')}}</label>
                            {!! Form::select('permission[]',$permission,null, [
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
