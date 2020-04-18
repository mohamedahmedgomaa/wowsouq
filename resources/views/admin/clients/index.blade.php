@extends('admin.layouts.app')

@section('small_title')
    {{trans('admin.client')}}
@endsection
@section('page_title')
    {{trans('admin.listClient')}}
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            @include('flash::message')
            {!! Form::open(['id'=>'form_data', 'url'=>url('admin/client/destroy/all'),'method'=>'delete']) !!}
            {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover'], true) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>

    <!-- Modal -->
    <div id="multipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <div class="empty_record hidden">
                            <h4>{{ trans('admin.please_check_some_record') }} </h4>
                        </div>
                        <div class="not_empty_record hidden">
                            <h4>{{ trans('admin.ask_delete_item') }} <span class="record_count"></span> ?</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ trans('admin.close') }}</button>
                    </div>
                    <div class="not_empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{ trans('admin.no') }}</button>
                        <input type="submit" name="del_all" value="{{ trans('admin.yes') }}"
                               class="btn btn-danger del_all">
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('js')
        <script>
            delete_all();
        </script>
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
