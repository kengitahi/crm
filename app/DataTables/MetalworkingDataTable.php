<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Models\ProjectFinances\Metalworking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MetalworkingDataTable extends BaseDataTable
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $datatables = datatables()->eloquent($query);
        $datatables->setRowId(fn ($row) => 'row-'.$row->id);
        $datatables->addColumn('action', function ($row) {
            $action =
                '<div class="task_view">
                    <div class="dropdown">
                        <a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link"
                            id="dropdownMenuLink-'.
                $row->id.
                '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-options-vertical icons"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-'.
                $row->id.
                '" tabindex="0">';

            $action .=
                '<a class="dropdown-item openRightModal" href="'.
                route('projectfinances.form', [
                    'action' => 'edit',
                    'model' => 'Metalworking',
                    'id' => $row->id,
                    'tab' => 'metalworking',
                ]).
                '">
                                <i class="fa fa-edit mr-2"></i>
                                '.
                trans('app.edit').
                '</a>';

            $action .=
                '<a class="dropdown-item delete-table-row" href="javascript:;" data-row-id="'.
                $row->id.
                '">
                    <i class="fa fa-trash mr-2"></i>
                        '.
                trans('app.delete').
                '</a>';

            $action .= '</div>
                    </div>
                </div>';

            return $action;
        });

        $datatables->addColumn(
            'suppliers',
            fn ($row) => $row->suppliers ?: '--'
        );
        $datatables->addColumn(
            'materials',
            fn ($row) => $row->materials ?: '--'
        );
        $datatables->addColumn('labour', fn ($row) => $row->labour ?: '--');

        $datatables->editColumn(
            'created_at',
            fn ($row) => Carbon::parse($row->created_at)->translatedFormat(
                $this->company->date_format
            )
        );

        $customFieldColumns = CustomField::customFieldData(
            $datatables,
            Metalworking::CUSTOM_FIELD_MODEL
        );

        $datatables->rawColumns(array_merge(['action'], $customFieldColumns));

        // return (new EloquentDataTable($query))->setRowId("id");
        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Metalworking $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dataTable = $this->setBuilder('metalworking-table');

        $dataTable->setTableId('metalworking-table');
        $dataTable->columns($this->getColumns());
        $dataTable->orderBy(0, 'asc');
        $dataTable->selectStyleSingle();

        $dataTable->parameters([
            'initComplete' => 'function () {
                   window.LaravelDataTables["metalworking-table"].buttons().container()
                    .appendTo("#table-actions")
                }',
            'fnDrawCallback' => 'function( oSettings ) {
                  //
                }',
        ]);
        $dataTable->buttons(
            Button::make([
                'extend' => 'excel',
                'text' => '<i class="fa fa-file-export"></i> '.
                    trans('app.exportExcel'),
            ])
        );

        return $dataTable;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [
            Column::make('id'),
            __('modules.projects.formLabels.suppliers') => [
                'data' => 'suppliers',
                'name' => 'suppliers',
                'title' => __('modules.projects.formLabels.suppliers'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.materials') => [
                'data' => 'materials',
                'name' => 'materials',
                'title' => __('modules.projects.formLabels.materials'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.labour') => [
                'data' => 'labour',
                'name' => 'labour',
                'title' => __('modules.projects.formLabels.labour'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('app.createdAt') => [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => __('app.createdAt'),
            ],
            __('app.updatedOn') => [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => __('app.updatedOn'),
            ],
        ];

        $action = [
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-right pr-20'),
        ];

        return array_merge(
            $columns,
            CustomFieldGroup::customFieldsDataMerge(new Metalworking),
            $action
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Metalworking_'.date('YmdHis');
    }
}
