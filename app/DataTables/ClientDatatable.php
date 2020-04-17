<?php

namespace App\DataTables;

use App\Model\Client;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Services\DataTable;

class ClientDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.clients.btn.checkbox')
            ->addColumn('edit', 'admin.clients.btn.edit')
            ->addColumn('delete', 'admin.clients.btn.delete')
            ->addColumn('wallets', 'admin.clients.btn.wallet')
            ->addColumn('image', 'admin.clients.btn.image')
            ->rawColumns([
                'checkbox',
                'edit',
                'delete',
                'wallets',
                'image',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AdminDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Client::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'        => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100], [10,25,50, trans('admin.all_record')]],
                'buttons'    =>[
                    [
                        'text' => '<i class="fa fa-plus"></i> '. trans('admin.create_client'),
                        'className' => 'btn btn-info',"action"=>"function(){
                                    window.location.href = '". \URL::current() ."/create';
                                 }"
                    ],

                    ['extend'   => 'print', 'className' => 'btn btn-primary',
                        'text' => '<i class="fa fa-print"></i>'],
                    ['extend'   => 'csv', 'className' => 'btn btn-info',
                        'text' => '<i class="fa fa-file"></i> '. trans('admin.ex_csv')],
                    ['extend'   => 'excel', 'className' => 'btn btn-success',
                        'text' => '<i class="fa fa-file"></i> '. trans('admin.ex_excel')],
                    ['extend'   => 'reload', 'className' => 'btn btn-default',
                        'text' => '<i class="fa fa-refresh"></i> '],
                    [
                        'text' => '<i class="fa fa-trash"></i> ',
                        'className' => 'btn btn-danger delBtn',
                    ],
                ],
                'initComplete' => " function () {
                            this.api().columns([2,3,4,5,6]).every(function() {
                                    var column = this;
                                    var input = document.createElement(\"input\");
                                    $(input).appendTo($(column.footer()).empty())
                                    .on('keyup', function() {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    });
                            }",
                'language' => datatable_lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'          => 'checkbox',
                'data'          => 'checkbox',
                'title'         => '<input class="check_all" type="checkbox" onclick="check_all()"/>',
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,
            ],[
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ],[
                'name'  => 'name',
                'data'  => 'name',
                'title' => trans('admin.name'),
            ],[
                'name'  => 'email',
                'data'  => 'email',
                'title' => trans('admin.email'),
            ],[
                'name'  => 'phone',
                'data'  => 'phone',
                'title' => trans('admin.phone'),
            ],[
                'name'          => 'image',
                'data'          => 'image',
                'title'         => trans('admin.image'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,

            ],[
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => trans('admin.created_at'),
            ],[
                'name'  => 'wallet',
                'data'  => 'wallet',
                'title' => trans('admin.wallet'),
            ],[
                'name'          => 'wallets',
                'data'          => 'wallets',
                'title'         => trans('admin.wallets'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,

            ],[
                'name'          => 'edit',
                'data'          => 'edit',
                'title'         => trans('admin.edit'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,

            ],[
                'name'          => 'delete',
                'data'          => 'delete',
                'title'         => trans('admin.delete'),
                'exportable'    => false,
                'printable'     => false,
                'orderable'     => false,
                'searchable'    => false,

            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clients_' . date('YmdHis');
    }
}

