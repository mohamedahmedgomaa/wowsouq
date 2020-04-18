@extends('admin.layouts.app')

@section('small_title')
    {{trans('admin.client')}}
@endsection
@section('page_title')
    {{trans('admin.listSoftDeletedClient')}}
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            @include('flash::message')
            {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover'], true) !!}
        </div>
        <!-- /.box-body -->
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
