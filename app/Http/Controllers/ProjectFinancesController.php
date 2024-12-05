<?php

namespace App\Http\Controllers;

use App\Helper\Reply;
use App\Http\Requests\ProjectFinancesRequest;
use App\Models\ProjectFinance;
use App\Models\ProjectFinances\LicensesAndPermits;
use Illuminate\Http\Request;

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
            'additionalCosts' => $this->additionalCosts(),
            'otherCosts' => $this->otherCosts(),
            'operation' => $this->operation(),
            default => $this->preliminary(),
        };

        //Return view for now
        return view('project-finances.index', $this->data);
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
    public function store(Request $request) {}

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
    public function update(Request $request, ProjectFinance $projectFinance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectFinance $projectFinance)
    {
        //
    }

    //Main views will show tables
    //Ajax views will show forms

    public function preliminary()
    {
        return view('project-finances.index', $this->data);
    }

    public function licenses()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.licenses');
        $this->view = 'project-finances.licenses';
        $this->activeTab = 'licenses';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.licenses').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function urbanization()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.urbanization');
        $this->view = 'project-finances.urbanization';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.urbanization').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
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

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.building').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.building';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function concrete()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.concrete');
        $this->view = 'project-finances.concrete';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.concrete').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.concrete';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function steel()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.steel');
        $this->view = 'project-finances.steel';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.steel').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.steel';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function masonry()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.masonry');
        $this->view = 'project-finances.masonry';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.masonry').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.masonry';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function materials()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.materials');
        $this->view = 'project-finances.materials';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.materials').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.materials';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function finishes()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.finishes');
        $this->view = 'project-finances.finishes';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.finishes').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.finishes';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function plumbing()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.plumbing');
        $this->view = 'project-finances.plumbing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.plumbing').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
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

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.wiring').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.wiring';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function kitchens()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.kitchens');
        $this->view = 'project-finances.kitchens';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.kitchens').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.kitchens';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function capentry()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.capentry');
        $this->view = 'project-finances.capentry';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.capentry').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.capentry';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function metalworking()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.metalworking');
        $this->view = 'project-finances.metalworking';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.metalworking').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.metalworking';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function painting()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.painting');
        $this->view = 'project-finances.painting';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.painting').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.painting';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function aircon()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.aircon');
        $this->view = 'project-finances.aircon';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.aircon').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.aircon';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function waterproofing()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.waterproofing');
        $this->view = 'project-finances.waterproofing';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.waterproofing').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.waterproofing';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function gardening()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.gardening');
        $this->view = 'project-finances.gardening';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.gardening').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.gardening';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function walls()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.walls');
        $this->view = 'project-finances.walls';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.walls').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.walls';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function additionalCosts()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.additionalCosts');
        $this->view = 'project-finances.additionalCosts';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.additionalCosts').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.additionalCosts';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function otherCosts()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.otherCosts');
        $this->view = 'project-finances.otherCosts';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.otherCosts').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.otherCosts';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    public function operation()
    {
        $this->pageTitle =
            'Project Finances - '.__('modules.projects.tabs.operation');
        $this->view = 'project-finances.operation';

        if (request()->ajax()) {
            $this->pageTitle =
                __('modules.projects.addNew').' '.__('modules.projects.tabs.operation').' '.__('modules.projects.record');
            $this->view = 'project-finances.ajax.licenses';
            $this->view = 'project-finances.ajax.operation';

            return $this->returnAjax($this->view);
        }

        return view('project-finances.index', $this->data);
    }

    //Requests and saving data

    public function storeLicenses(ProjectFinancesRequest $request)
    {
        $validatedData = $request->validated();
        $redirectUrl = route('projectfinances.index').'?tab=licenses';
        // Process licenses form data
        $licenses = LicensesAndPermits::create($validatedData);

        return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => $redirectUrl]);
    }
}
