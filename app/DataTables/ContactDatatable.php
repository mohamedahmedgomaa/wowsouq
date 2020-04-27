<?php

namespace App\DataTables;

use App\Model\Contact;
use Yajra\DataTables\Services\DataTable;

class ContactDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.contacts.btn.checkbox')
            ->addColumn('type', 'admin.contacts.btn.type')
            ->addColumn('message', 'admin.contacts.btn.message')
            ->addColumn('delete', 'admin.contacts.btn.delete')
            ->rawColumns([
                'delete',
                'checkbox',
                'type',
                'message',
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
        return Contact::query();
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
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-primary',
                        'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info',
                        'text' => '<i class="fa fa-file"></i> ' . trans('admin.ex_csv')],
                    ['extend' => 'excel', 'className' => 'btn btn-success',
                        'text' => '<i class="fa fa-file"></i> ' . trans('admin.ex_excel')],
                    ['extend' => 'reload', 'className' => 'btn btn-default',
                        'text' => '<i class="fa fa-refresh"></i> '],
                    [
                        'text' => '<i class="fa fa-trash"></i> ',
                        'className' => 'btn btn-danger delBtn',
                    ],
                ],
                'initComplete' => " function () {
                            this.api().columns([2,3,4,5]).every(function() {
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
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input class="check_all" type="checkbox" onclick="check_all()"/>',
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID',
            ], [
                'name' => 'type',
                'data' => 'type',
                'title' => trans('admin.type'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('admin.name'),
            ], [
                'name' => 'email',
                'data' => 'email',
                'title' => trans('admin.email'),
            ], [
                'name' => 'phone',
                'data' => 'phone',
                'title' => trans('admin.phone'),
            ], [
                'name' => 'message',
                'data' => 'message',
                'title' => trans('admin.message'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ], [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('admin.delete'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
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
        return 'contacts_' . date('YmdHis');
    }
}

