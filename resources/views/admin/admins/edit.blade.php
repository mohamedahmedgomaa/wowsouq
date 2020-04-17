@extends('admin.layouts.app')
@inject('perm', 'Spatie\Permission\Models\Role')

<?php
$roles = $perm->pluck('name', 'id')->toArray();
?>
@section('page_title')
    {{trans('admin.adminEdit')}}
@endsection
@section('small_title')
    {{trans('admin.admin')}}
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.adminEdit')}}</h3>
        </div>
        <div class="box-body">
            <div class="box">
                @include('flash::message')
                @include('partials.validations_errors')
                <div class="box-body">
                    {!! Form::model($model, [
                        'action' => ['Admin\AdminController@update',$model->id],
                        'method' =>'put'
                    ]) !!}
                    @include('admin.admins.form')
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="name">{{trans('admin.roles')}}</label><br>
                            <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label>
                            <br>
                            <div class="row">
                                @foreach($perm->all() as $role)
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                                       @if($model->hasRole($role->name))
                                                       checked="checked"
                                                    @endif
                                                >
                                                {{$role->name_ar}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

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
@push('js')
    <script>
        $("#select-all").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    </script>
@endpush
