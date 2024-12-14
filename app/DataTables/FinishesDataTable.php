<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Models\ProjectFinances\Finishes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FinishesDataTable extends BaseDataTable
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
                    'model' => 'Finishes',
                    'id' => $row->id,
                    'tab' => 'finishes',
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
            'woodenStairs',
            fn ($row) => $row->wooden_stairs ?: '--'
        );
        $datatables->addColumn(
            'marbleAndGranites',
            fn ($row) => $row->wooden_stairs ?: '--'
        );
        $datatables->addColumn(
            'woodenStave',
            fn ($row) => $row->wooden_stave ?: '--'
        );
        $datatables->addColumn(
            'wallCovering',
            fn ($row) => $row->wall_covering ?: '--'
        );
        $datatables->addColumn('kitchens', fn ($row) => $row->kitchens ?: '--');
        $datatables->addColumn(
            'carpentry',
            fn ($row) => $row->carpentry ?: '--'
        );
        $datatables->addColumn(
            'bathroomFurniture',
            fn ($row) => $row->bathroom_furniture ?: '--'
        );
        $datatables->addColumn(
            'outdoorAreas',
            fn ($row) => $row->outdoor_areas ?: '--'
        );
        $datatables->addColumn(
            'marbleSlabs',
            fn ($row) => $row->marble_slabs ?: '--'
        );
        $datatables->addColumn('floor', fn ($row) => $row->floors ?: '--');
        $datatables->addColumn(
            'finishes_labour',
            fn ($row) => $row->finishes_labour ?: '--'
        );
        $datatables->addColumn(
            'finishes_suppliers',
            fn ($row) => $row->finishes_suppliers ?: '--'
        );

        $datatables->editColumn(
            'created_at',
            fn ($row) => Carbon::parse($row->created_at)->translatedFormat(
                $this->company->date_format
            )
        );

        $customFieldColumns = CustomField::customFieldData(
            $datatables,
            Finishes::CUSTOM_FIELD_MODEL
        );

        $datatables->rawColumns(array_merge(['action'], $customFieldColumns));

        // return (new EloquentDataTable($query))->setRowId("id");
        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Finishes $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dataTable = $this->setBuilder('finishes-table');

        $dataTable->setTableId('finishes-table');
        $dataTable->columns($this->getColumns());
        $dataTable->orderBy(0, 'asc');
        $dataTable->selectStyleSingle();

        $dataTable->parameters([
            'initComplete' => 'function () {
                   window.LaravelDataTables["finishes-table"].buttons().container()
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
            __('modules.projects.formLabels.woodenStairs') => [
                'data' => 'wooden_stairs',
                'name' => 'wooden_stairs',
                'title' => __('modules.projects.formLabels.woodenStairs'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.marbleAndGranites') => [
                'data' => 'marble_and_granites',
                'name' => 'marbleAndGranites',
                'title' => __('modules.projects.formLabels.marbleAndGranites'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.woodenStave') => [
                'data' => 'wooden_stave',
                'name' => 'wooden_stave',
                'title' => __('modules.projects.formLabels.woodenStave'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.wallCovering') => [
                'data' => 'wall_covering',
                'name' => 'wall_covering',
                'title' => __('modules.projects.formLabels.wallCovering'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.kitchens') => [
                'data' => 'kitchens',
                'name' => 'kitchens',
                'title' => __('modules.projects.formLabels.kitchens'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.carpentry') => [
                'data' => 'carpentry',
                'name' => 'carpentry',
                'title' => __('modules.projects.formLabels.carpentry'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.bathroomFurniture') => [
                'data' => 'bathroom_furniture',
                'name' => 'bathroomFurniture',
                'title' => __('modules.projects.formLabels.bathroomFurniture'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.outdoorAreas') => [
                'data' => 'outdoor_areas',
                'name' => 'outdoorAreas',
                'title' => __('modules.projects.formLabels.outdoorAreas'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.marbleSlabs') => [
                'data' => 'marble_slabs',
                'name' => 'marbleSlabs',
                'title' => __('modules.projects.formLabels.marbleSlabs'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.floor') => [
                'data' => 'floors',
                'name' => 'floor',
                'title' => __('modules.projects.formLabels.floor'),
                'visible' => showId(),
                'orderable' => false,
            ],
            'Finishes '.__('modules.projects.formLabels.suppliers') => [
                'data' => 'finishes_suppliers',
                'name' => 'finishes_suppliers',
                'title' => 'Finishes '.__('modules.projects.formLabels.suppliers'),
                'visible' => showId(),
                'orderable' => false,
            ],
            'Finishes '.__('modules.projects.formLabels.labour') => [
                'data' => 'finishes_labour',
                'name' => 'finishes_labour',
                'title' => 'Finishes '.__('modules.projects.formLabels.labour'),
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
            CustomFieldGroup::customFieldsDataMerge(new Finishes),
            $action
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Finishes_'.date('YmdHis');
    }
}
