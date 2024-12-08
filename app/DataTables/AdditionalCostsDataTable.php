<?php

namespace App\DataTables;

use App\Models\ProjectFinances\AdditionalCosts;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class AdditionalCostsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // return (new EloquentDataTable($query))
        //     ->setRowId('id');

        $datatables = datatables()->eloquent($query);

        $datatables->setRowId('additionalcosts-table');
        $datatables->addColumn('id', function ($row) {
            return $row->id;
        });
        $datatables->editColumn('imss', function ($row) {
            return $row->imss;
        });

        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AdditionalCosts $model): QueryBuilder
    {
        return $model->newQuery();
        // $model = $model->select('id', 'imss', 'infornavit', 'accounting', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        // return $this->builder()
        //     ->setTableId('additionalcosts-table')
        //     ->columns($this->getColumns())
        //     ->orderBy(1)
        //     ->selectStyleSingle()
        //     ->buttons([
        //         Button::make('create'),
        //         Button::make('export'),
        //         Button::make('print'),
        //         Button::make('reset'),
        //         Button::make('reload'),
        //     ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $data = [
            '#' => ['data' => 'id', 'orderable' => false, 'searchable' => false, 'visible' => false, 'title' => '#'],
            __('app.id') => ['data' => 'id', 'name' => 'id', 'title' => __('app.id'), 'visible' => showId()],
            __('modules.projects.formLabels.imss') => ['data' => 'imss', 'name' => 'imss', 'title' => __('modules.projects.formLabels.imss'), 'exportable' => true],
            __('modules.projects.formLabels.infornavit') => ['data' => 'infornavit', 'name' => 'infornavit', 'title' => __('modules.projects.formLabels.imss'), 'exportable' => true],
            __('modules.projects.formLabels.accounting') => ['data' => 'accounting', 'name' => 'accounting', 'title' => __('modules.projects.formLabels.accounting'), 'exportable' => true],
        ];

        return $data;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AdditionalCosts_'.date('YmdHis');
    }
}
