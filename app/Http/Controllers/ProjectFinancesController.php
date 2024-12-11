<?php

namespace App\Http\Controllers;

use App\DataTables\AdditionalCostsDataTable;
use App\Helper\Reply;
use App\Http\Requests\ProjectFinancesRequest;
use App\Models\ProjectFinance;
use App\Models\ProjectFinances\AdditionalCosts;
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
use Illuminate\Http\Request;

class ProjectFinancesController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Project Finances';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('payments', $this->user->modules));

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
            'licenses' => $this->licenses(),
            'urbanization' => $this->urbanization(),
            'building' => $this->building(),
            'concrete' => $this->concrete(),
            'steel' => $this->steel(),
            'masonry' => $this->masonry(),
            'materials' => $this->materials(),
            'finishes' => $this->finishes(),
            'plumbing' => $this->plumbing(),
            'wiring' => $this->wiring(),
            'kitchens' => $this->kitchens(),
            'capentry' => $this->capentry(),
            'metalworking' => $this->metalworking(),
            'painting' => $this->painting(),
            'aircon' => $this->aircon(),
            'waterproofing' => $this->waterproofing(),
            'gardening' => $this->gardening(),
            'walls' => $this->walls(),
            'additionalCosts' => $this->additionalCosts(
                new AdditionalCostsDataTable
            ),
            'otherCosts' => $this->otherCosts(),
            'operation' => $this->operation(),
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $this->view = 'project-finances.index';

        return view('project-finances.index', $this->data);
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
        $redirectUrl = route('projectfinances.index') . '?tab=additionalCosts';

        $model = request('model');
        $id = request('id');

        $costToUpdate = "App\Models\ProjectFinances\\$model";

        $this->costToUpdate = $costToUpdate::find($id);
        $this->costToUpdate->update($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $redirectUrl = route('projectfinances.index') . '?tab=additionalCosts';

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

    public function additionalCosts(AdditionalCostsDataTable $dataTable)
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.additionalCosts');
        $this->view = 'project-finances.additionalCosts';
        $this->activeTab = 'additionalCosts';

        return $dataTable->render('project-finances.index', $this->data);
    }

    public function additionalCostsForm()
    {
        $this->pageTitle =
            __('modules.projects.addNew') .
            ' ' .
            __('modules.projects.tabs.additionalCosts') .
            ' ' .
            __('modules.projects.record');
        $this->view = 'project-finances.ajax.additionalCosts';

        $this->costToEdit = AdditionalCosts::find(request('id'));

        return $this->returnAjax($this->view);
    }

    public function storeAdditionalCosts(ProjectFinancesRequest $request, $action = null, $id = null)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=additionalCosts';

        AdditionalCosts::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function licenses()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.licenses');
        $this->view = 'project-finances.licenses';
        $this->activeTab = 'licenses';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.licenses') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function urbanization()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.urbanization');
        $this->view = 'project-finances.urbanization';
        $this->activeTab = 'urbanization';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.urbanization') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.urbanization';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function building()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.building');
        $this->view = 'project-finances.building';
        $this->activeTab = 'building';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.building') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.building';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function concrete()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.concrete');
        $this->view = 'project-finances.concrete';
        $this->activeTab = 'concrete';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.concrete') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.concrete';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function steel()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.steel');
        $this->view = 'project-finances.steel';
        $this->activeTab = 'steel';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.steel') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.steel';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function masonry()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.masonry');
        $this->activeTab = 'masonry';
        $this->view = 'project-finances.masonry';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.masonry') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.masonry';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function materials()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.materials');
        $this->view = 'project-finances.materials';
        $this->activeTab = 'materials';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.materials') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.materials';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function finishes()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.finishes');
        $this->view = 'project-finances.finishes';
        $this->activeTab = 'finishes';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.finishes') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.finishes';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function plumbing()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.plumbing');
        $this->view = 'project-finances.plumbing';
        $this->activeTab = 'plumbing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.plumbing') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.plumbing';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function wiring()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.wiring');
        $this->view = 'project-finances.wiring';
        $this->activeTab = 'wiring';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.wiring') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.wiring';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function kitchens()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.kitchens');
        $this->view = 'project-finances.kitchens';
        $this->activeTab = 'kitchens';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.kitchens') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.kitchens';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function capentry()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.capentry');
        $this->view = 'project-finances.capentry';
        $this->activeTab = 'capentry';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.capentry') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.capentry';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function metalworking()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.metalworking');
        $this->view = 'project-finances.metalworking';
        $this->activeTab = 'metalworking';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.metalworking') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.metalworking';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function painting()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.painting');
        $this->view = 'project-finances.painting';
        $this->activeTab = 'painting';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.painting') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.painting';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function aircon()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.aircon');
        $this->view = 'project-finances.aircon';
        $this->activeTab = 'aircon';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.aircon') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.aircon';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function waterproofing()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.waterproofing');
        $this->view = 'project-finances.waterproofing';
        $this->activeTab = 'waterproofing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.waterproofing') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.waterproofing';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function gardening()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.gardening');
        $this->view = 'project-finances.gardening';
        $this->activeTab = 'gardening';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.gardening') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.gardening';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function walls()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.walls');
        $this->view = 'project-finances.walls';
        $this->activeTab = 'walls';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.walls') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.walls';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function otherCosts()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.otherCosts');
        $this->view = 'project-finances.otherCosts';
        $this->activeTab = 'otherCosts';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.otherCosts') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.otherCosts';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function operation()
    {
        $this->pageTitle =
            'Project Finances - ' . __('modules.projects.tabs.operation');
        $this->view = 'project-finances.operation';
        $this->activeTab = 'operation';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew') .
                ' ' .
                __('modules.projects.tabs.operation') .
                ' ' .
                __('modules.projects.record');
            $this->view = 'project-finances.ajax.operation';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    //Requests and saving data

    public function storeLicenses(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=licenses';

        LicensesAndPermits::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeUrbanization(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=urbanization';

        UrbanizationCost::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeBuilding(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=building';

        BuildingCost::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeConcrete(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=concrete';

        ConcreteStructure::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeSteel(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=steel';

        SteelStructure::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMasonry(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=masonry';

        GrayMasonryWork::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMaterials(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=materials';

        Materials::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeFinishes(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=finishes';

        Finishes::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storePlumbing(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=plumbing';

        Plumbing::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWiring(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=wiring';

        Wiring::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeKitchens(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=kitchens';

        Kitchens::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeCapentry(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=capentry';

        Capentry::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeMetalworking(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=metalworking';

        Metalworking::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storePainting(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=painting';

        Painting::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeAircon(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=aircon';

        AirCon::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWaterproofing(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=waterproofing';

        Waterproofing::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeGardening(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=gardening';

        Gardening::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeWalls(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=walls';

        Walls::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeOtherCosts(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=otherCosts';

        OtherCosts::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }

    public function storeOperation(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index') . '?tab=operation';

        Operation::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), [
            'redirectUrl' => $redirectUrl,
        ]);
    }
}
