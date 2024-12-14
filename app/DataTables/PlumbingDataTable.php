<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Models\ProjectFinances\Plumbing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PlumbingDataTable extends BaseDataTable
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
                    'model' => 'Plumbing',
                    'id' => $row->id,
                    'tab' => 'plumbing',
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
            'labour',
            fn ($row) => $row->labour ?: '--'
        );

        $datatables->addColumn(
            'materials',
            fn ($row) => $row->materials ?: '--'
        );

        $datatables->addColumn(
            'hydropneumaticSystem',
            fn ($row) => $row->hydropneumatic_system ?: '--'
        );

        $datatables->addColumn(
            'sprinklerIrrigationSystem',
            fn ($row) => $row->automated_sprinkler ?: '--'
        );

        $datatables->addColumn(
            'tank',
            fn ($row) => $row->tank ?: '--'
        );

        $datatables->addColumn(
            'basicMaterial',
            fn ($row) => $row->basic_material ?: '--'
        );

        $datatables->addColumn(
            'heater',
            fn ($row) => $row->heater ?: '--'
        );

        $datatables->addColumn(
            'bathroom',
            fn ($row) => $row->bathroom ?: '--'
        );

        $datatables->editColumn(
            'created_at',
            fn ($row) => Carbon::parse($row->created_at)->translatedFormat(
                $this->company->date_format
            )
        );

        $customFieldColumns = CustomField::customFieldData(
            $datatables,
            Plumbing::CUSTOM_FIELD_MODEL
        );

        $datatables->rawColumns(array_merge(['action'], $customFieldColumns));

        // return (new EloquentDataTable($query))->setRowId("id");
        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Plumbing $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dataTable = $this->setBuilder('plumbing-table');

        $dataTable->setTableId('plumbing-table');
        $dataTable->columns($this->getColumns());
        $dataTable->orderBy(0, 'asc');
        $dataTable->selectStyleSingle();

        $dataTable->parameters([
            'initComplete' => 'function () {
                   window.LaravelDataTables["plumbing-table"].buttons().container()
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

            __('modules.projects.formLabels.hydropneumaticSystem') => [
                'data' => 'hydropneumatic_system',
                'name' => 'hydropneumaticSystem',
                'title' => __('modules.projects.formLabels.hydropneumaticSystem'),
                'visible' => showId(),
                'orderable' => false,
            ],

            __('modules.projects.formLabels.sprinklerIrrigationSystem') => [
                'data' => 'automated_sprinkler',
                'name' => 'sprinklerIrrigationSystem',
                'title' => __('modules.projects.formLabels.sprinklerIrrigationSystem'),
                'visible' => showId(),
                'orderable' => false,
            ],

            __('modules.projects.formLabels.tank') => [
                'data' => 'tank',
                'name' => 'tank',
                'title' => __('modules.projects.formLabels.tank'),
                'visible' => showId(),
                'orderable' => false,
            ],

            __('modules.projects.formLabels.basicMaterial') => [
                'data' => 'materials',
                'name' => 'materials',
                'title' => __('modules.projects.formLabels.basicMaterial'),
                'visible' => showId(),
                'orderable' => false,
            ],

            __('modules.projects.formLabels.heater') => [
                'data' => 'heater',
                'name' => 'heater',
                'title' => __('modules.projects.formLabels.heater'),
                'visible' => showId(),
                'orderable' => false,
            ],

            __('modules.projects.formLabels.bathroom') => [
                'data' => 'bathroom',
                'name' => 'bathroom',
                'title' => __('modules.projects.formLabels.bathroom'),
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
            CustomFieldGroup::customFieldsDataMerge(new Plumbing),
            $action
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Plumbing_'.date('YmdHis');
    }
}
