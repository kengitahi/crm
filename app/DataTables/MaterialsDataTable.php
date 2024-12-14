<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Models\ProjectFinances\Materials;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MaterialsDataTable extends BaseDataTable
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
                    'model' => 'Materials',
                    'id' => $row->id,
                    'tab' => 'materials',
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
            fn ($row) => $row->concrete_suppliers ?: '--'
        );

        $datatables->addColumn(
            'rodWireAndArmex',
            fn ($row) => $row->rod_wire_armex ?: '--'
        );

        $datatables->addColumn(
            'prefabricatedSystems',
            fn ($row) => $row->prefabricated_systems ?: '--'
        );

        $datatables->addColumn(
            'cementAndMortar',
            fn ($row) => $row->cement_mortar ?: '--'
        );

        $datatables->addColumn(
            'premixedConcrete',
            fn ($row) => $row->premixed_concrete ?: '--'
        );

        $datatables->addColumn(
            'blockAndBrick',
            fn ($row) => $row->block_and_brick ?: '--'
        );

        $datatables->addColumn(
            'basicMaterials',
            fn ($row) => $row->basic_material ?: '--'
        );

        $datatables->addColumn(
            'sandAndMaterialFreight',
            fn ($row) => $row->sand_and_material_freight ?: '--'
        );

        $datatables->addColumn(
            'waterproofing',
            fn ($row) => $row->waterproofing ?: '--'
        );

        $datatables->addColumn(
            'miscNotesAndHardware',
            fn ($row) => $row->miscellaneous ?: '--'
        );

        $datatables->editColumn(
            'created_at',
            fn ($row) => Carbon::parse($row->created_at)->translatedFormat(
                $this->company->date_format
            )
        );

        $customFieldColumns = CustomField::customFieldData(
            $datatables,
            Materials::CUSTOM_FIELD_MODEL
        );

        $datatables->rawColumns(array_merge(['action'], $customFieldColumns));

        // return (new EloquentDataTable($query))->setRowId("id");
        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Materials $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dataTable = $this->setBuilder('materials-table');

        $dataTable->setTableId('materials-table');
        $dataTable->columns($this->getColumns());
        $dataTable->orderBy(0, 'asc');
        $dataTable->selectStyleSingle();

        $dataTable->parameters([
            'initComplete' => 'function () {
                   window.LaravelDataTables["materials-table"].buttons().container()
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
            __('modules.projects.formLabels.rodWireAndArmex') => [
                'data' => 'rod_wire_armex',
                'name' => 'rod_wire_armex',
                'title' => __('modules.projects.formLabels.rodWireAndArmex'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.prefabricatedSystems') => [
                'data' => 'prefabricated_systems',
                'name' => 'prefabricated_systems',
                'title' => __(
                    'modules.projects.formLabels.prefabricatedSystems'
                ),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.cementAndMortar') => [
                'data' => 'cement_mortar',
                'name' => 'cement_mortar',
                'title' => __('modules.projects.formLabels.cementAndMortar'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.premixedConcrete') => [
                'data' => 'premixed_concrete',
                'name' => 'premixed_concrete',
                'title' => __('modules.projects.formLabels.premixedConcrete'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.blockAndBrick') => [
                'data' => 'block_and_brick',
                'name' => 'block_and_brick',
                'title' => __('modules.projects.formLabels.blockAndBrick'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.basicMaterials') => [
                'data' => 'basic_material',
                'name' => 'basic_material',
                'title' => __('modules.projects.formLabels.basicMaterials'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.sandAndMaterialFreight') => [
                'data' => 'sand_and_material_freight',
                'name' => 'sand_and_material_freight',
                'title' => __(
                    'modules.projects.formLabels.sandAndMaterialFreight'
                ),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.waterproofing') => [
                'data' => 'waterproofing',
                'name' => 'waterproofing',
                'title' => __('modules.projects.formLabels.waterproofing'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.miscNotesAndHardware') => [
                'data' => 'miscellaneous',
                'name' => 'miscellaneous',
                'title' => __(
                    'modules.projects.formLabels.miscNotesAndHardware'
                ),
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
            CustomFieldGroup::customFieldsDataMerge(new Materials),
            $action
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Concrete_structure_'.date('YmdHis');
    }
}
