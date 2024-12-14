<?php

namespace App\Http\Controllers;

use App\DataTables\AdditionalCostsDataTable;
use App\DataTables\AirconDataTable;
use App\DataTables\CarpentryDataTable;
use App\DataTables\ConcreteDataTable;
use App\DataTables\FinishesDataTable;
use App\DataTables\GardeningDataTable;
use App\DataTables\KitchensDataTable;
use App\DataTables\LicensesDataTable;
use App\DataTables\MasonryDataTable;
use App\DataTables\MaterialsDataTable;
use App\DataTables\MetalworkingDataTable;
use App\DataTables\OperationDataTable;
use App\DataTables\OtherCostsDataTable;
use App\DataTables\PaintingDataTable;
use App\DataTables\PlumbingDataTable;
use App\DataTables\SteelDataTable;
use App\Helper\Reply;
use App\Http\Requests\ProjectFinancesRequest;
use App\Models\ProjectFinance;
use App\Models\ProjectFinances\AirCon;
use App\Models\ProjectFinances\BuildingCost;
use App\Models\ProjectFinances\Capentry;
use App\Models\ProjectFinances\ConcreteStructure;
use App\Models\ProjectFinances\Finishes;
use App\Models\ProjectFinances\Gardening;
use App\Models\ProjectFinances\GrayMasonryWork;
use App\Models\ProjectFinances\Kitchens;
use App\Models\ProjectFinances\LicensesAndPermits;
use App\Models\ProjectFinances\Materials;
use App\Models\ProjectFinances\Metalworking;
use App\Models\ProjectFinances\Operation;
use App\Models\ProjectFinances\OtherCosts;
use App\Models\ProjectFinances\Painting;
use App\Models\ProjectFinances\Plumbing;
use App\Models\ProjectFinances\SteelStructure;
use App\Models\ProjectFinances\UrbanizationCost;
use App\Models\ProjectFinances\Walls;
use App\Models\ProjectFinances\Waterproofing;
use App\Models\ProjectFinances\Wiring;

class ProjectFinancesController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Project Finances';
        $this->middleware(function ($request, $next) {
            abort_403(! in_array('payments', $this->user->modules));

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->view = 'project-finances.preliminary';
        $tab = request('tab');
        $this->activeTab = $tab ?: 'preliminary';

        return match ($tab) {
            'licenses' => $this->show(new LicensesDataTable, 'licenses'),
            'urbanization' => $this->urbanization(),
            'building' => $this->building(),
            'concrete' => $this->show(new ConcreteDataTable, 'concrete'),
            'steel' => $this->show(new SteelDataTable, 'steel'),
            'masonry' => $this->show(new MasonryDataTable, 'masonry'),
            'materials' => $this->show(new MaterialsDataTable, 'materials'),
            'finishes' => $this->show(new FinishesDataTable, 'finishes'),
            'plumbing' => $this->show(new PlumbingDataTable, 'plumbing'),
            'wiring' => $this->wiring(),
            'kitchens' => $this->show(new KitchensDataTable, 'kitchens'),
            'capentry' => $this->show(new CarpentryDataTable, 'capentry'),
            'metalworking' => $this->show(
                new MetalworkingDataTable,
                'metalworking'
            ),
            'painting' => $this->show(new PaintingDataTable, 'painting'),
            'aircon' => $this->show(new AirconDataTable, 'aircon'),
            'waterproofing' => $this->waterproofing(),
            'gardening' => $this->show(new GardeningDataTable, 'gardening'),
            'walls' => $this->walls(),
            'additionalCosts' => $this->show(
                new AdditionalCostsDataTable,
                'additionalCosts'
            ),
            'otherCosts' => $this->show(
                new OtherCostsDataTable,
                'otherCosts'
            ),
            'operation' => $this->show(new OperationDataTable, 'operation'),
            default => view('project-finances.index', $this->data),
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectFinancesRequest $request)
    {
        $tab = request('tab');
        $model = request('model');
        $modelToStore = "App\Models\ProjectFinances\\$model";

        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index')."?tab=$tab";

        $modelToStore::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($dataTable, $title)
    {
        $this->pageTitle =
            'Project Finances - '.__("modules.projects.tabs.$title");
        $this->view = "project-finances.$title";
        $this->activeTab = $title;

        return $dataTable->render('project-finances.index', $this->data);
    }

    public function form()
    {
        $title = request('tab');
        $tab = request('tab');
        $id = request('id');

        if (request()->action == 'edit') {
            $model = request('model');
            $modelToUpdate = "App\Models\ProjectFinances\\$model";
            $this->costToEdit = $modelToUpdate::find($id);
        }

        request()->action == 'edit'
            ? ($titleAction = __('modules.projects.edit'))
            : ($titleAction = __('modules.projects.addNew'));

        $this->pageTitle =
            $titleAction.
            ' '.
            __("modules.projects.tabs.$title").
            ' '.
            __('modules.projects.record');

        $this->view = "project-finances.ajax.$tab";

        return $this->returnAjax($this->view);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectFinance $projectFinance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();

        $model = request('model');
        $id = request('id');
        $tab = request('tab');

        $costToUpdate = "App\Models\ProjectFinances\\$model";

        $this->costToUpdate = $costToUpdate::find($id);
        $this->costToUpdate->update($validatedData);

        $redirectUrl = route('projectfinances.index')."?tab=$tab";

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $redirectUrl = route('projectfinances.index').'?tab=additionalCosts';

        $model = request('model');
        $id = request('id');

        $costToDelete = "App\Models\ProjectFinances\\$model";

        $this->costToDelete = $costToDelete::find($id);
        $this->costToDelete->delete();

        return Reply::successWithData(__('messages.deleteSuccess'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    //Main views will show tables
    //Ajax views will show forms

    public function preliminary()
    {
        return view('project-finances.index', $this->data);
    }

    public function urbanization()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.urbanization');
        $this->view = 'project-finances.urbanization';
        $this->activeTab = 'urbanization';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.urbanization').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.urbanization';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function building()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.building');
        $this->view = 'project-finances.building';
        $this->activeTab = 'building';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.building').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.building';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function steel()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.steel');
        $this->view = 'project-finances.steel';
        $this->activeTab = 'steel';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.steel').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.steel';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function plumbing()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.plumbing');
        $this->view = 'project-finances.plumbing';
        $this->activeTab = 'plumbing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.plumbing').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.plumbing';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function wiring()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.wiring');
        $this->view = 'project-finances.wiring';
        $this->activeTab = 'wiring';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.wiring').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.wiring';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function waterproofing()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.waterproofing');
        $this->view = 'project-finances.waterproofing';
        $this->activeTab = 'waterproofing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.waterproofing').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.waterproofing';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function walls()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.walls');
        $this->view = 'project-finances.walls';
        $this->activeTab = 'walls';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').
                ' '.
                __('modules.projects.tabs.walls').
                ' '.
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.walls';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    //Requests and saving data

    public function storeLicenses(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=licenses';

        LicensesAndPermits::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeUrbanization(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=urbanization';

        UrbanizationCost::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeBuilding(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=building';

        BuildingCost::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeConcrete(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=concrete';

        ConcreteStructure::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeSteel(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=steel';

        SteelStructure::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMasonry(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=masonry';

        GrayMasonryWork::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMaterials(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=materials';

        Materials::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeFinishes(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=finishes';

        Finishes::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storePlumbing(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=plumbing';

        Plumbing::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWiring(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=wiring';

        Wiring::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeKitchens(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=kitchens';

        Kitchens::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeCapentry(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=capentry';

        Capentry::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMetalworking(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=metalworking';

        Metalworking::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storePainting(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=painting';

        Painting::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeAircon(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=aircon';

        AirCon::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWaterproofing(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=waterproofing';

        Waterproofing::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeGardening(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=gardening';

        Gardening::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWalls(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=walls';

        Walls::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeOtherCosts(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=otherCosts';

        OtherCosts::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeOperation(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=operation';

        Operation::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }
}
