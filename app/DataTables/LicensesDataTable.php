<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Models\ProjectFinances\LicensesAndPermits;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LicensesDataTable extends BaseDataTable
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
                    'model' => 'LicensesAndPermits',
                    'id' => $row->id,
                    'tab' => 'licenses',
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
        $datatables->addColumn('who', fn ($row) => $row->who ?: '--');
        $datatables->addColumn('cfe', fn ($row) => $row->cfe ?: '--');
        $datatables->addColumn(
            'condominiumRegime',
            fn ($row) => $row->condominium_regime ?: '--'
        );
        $datatables->addColumn(
            'licenseAndAlignment',
            fn ($row) => $row->license_and_alignment ?: '--'
        );
        $datatables->addColumn('rooms', fn ($row) => $row->rooms ?: '--');
        $datatables->addColumn('mobility', fn ($row) => $row->mobility ?: '--');

        $datatables->editColumn(
            'created_at',
            fn ($row) => Carbon::parse($row->created_at)->translatedFormat(
                $this->company->date_format
            )
        );

        $customFieldColumns = CustomField::customFieldData(
            $datatables,
            LicensesAndPermits::CUSTOM_FIELD_MODEL
        );

        $datatables->rawColumns(array_merge(['action'], $customFieldColumns));

        // return (new EloquentDataTable($query))->setRowId("id");
        return $datatables;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LicensesAndPermits $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $dataTable = $this->setBuilder('licenses-table');

        $dataTable->setTableId('licenses-table');
        $dataTable->columns($this->getColumns());
        $dataTable->orderBy(0, 'asc');
        $dataTable->selectStyleSingle();

        $dataTable->parameters([
            'initComplete' => 'function () {
                   window.LaravelDataTables["licenses-table"].buttons().container()
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
            __('modules.projects.formLabels.who') => [
                'data' => 'who',
                'name' => 'who',
                'title' => __('modules.projects.formLabels.who'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.cfe') => [
                'data' => 'cfe',
                'name' => 'cfe',
                'title' => __('modules.projects.formLabels.cfe'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.condominiumRegime') => [
                'data' => 'condominium_regime',
                'name' => 'condominium_regime',
                'title' => __('modules.projects.formLabels.condominiumRegime'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.licenseAndAlignment') => [
                'data' => 'license_and_alignment',
                'name' => 'license_and_alignment',
                'title' => __(
                    'modules.projects.formLabels.licenseAndAlignment'
                ),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.rooms') => [
                'data' => 'rooms',
                'name' => 'rooms',
                'title' => __('modules.projects.formLabels.rooms'),
                'visible' => showId(),
                'orderable' => false,
            ],
            __('modules.projects.formLabels.mobility') => [
                'data' => 'mobility',
                'name' => 'mobility',
                'title' => __('modules.projects.formLabels.mobility'),
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
            CustomFieldGroup::customFieldsDataMerge(new LicensesAndPermits),
            $action
        );
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Licenses_and_Permits'.date('YmdHis');
    }
}
