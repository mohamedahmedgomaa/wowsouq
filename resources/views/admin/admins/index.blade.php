@extends('admin.layouts.app')

@section('small_title')
    {{trans('admin.admin')}}
@endsection
@section('page_title')
    {{trans('admin.listAdmin')}}
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            {!! $dataTable->table([], true) !!}
        </div>
        <!-- /.box-body -->
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
