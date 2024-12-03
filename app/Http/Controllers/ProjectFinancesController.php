<?php

namespace App\Http\Controllers;

use App\Models\ProjectFinance;
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

        $this->view = 'project-finances.ajax.show';
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
        return view(
            'project-finances.index',
            $this->data
        );
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $this->viewPermission = user()->user_role('admin');

        abort_403(! user()->user_role('admin'));

        $this->view = 'projectfinances.index';

        $tab = request('tab');

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

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        $this->activeTab = $tab ?: 'preliminary';

        return view('projectfinances.index', $this->data);

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

    public function preliminary()
    {
        return view('project-finances.index', $this->data);
    }

    public function licenses()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.licenses');
        $this->view = 'project-finances.ajax.licenses';

        return view('project-finances.index', $this->data);
    }

    public function urbanization()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.urbanization');
        $this->view = 'project-finances.ajax.urbanization';

        return view('project-finances.index', $this->data);
    }

    public function building()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.building');
        $this->view = 'project-finances.ajax.building';

        return view('project-finances.index', $this->data);
    }

    public function concrete()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.concrete');
        $this->view = 'project-finances.ajax.concrete';

        return view('project-finances.index', $this->data);
    }

    public function steel()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.steel');
        $this->view = 'project-finances.ajax.steel';

        return view('project-finances.index', $this->data);
    }

    public function masonry()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.masonry');
        $this->view = 'project-finances.ajax.masonry';

        return view('project-finances.index', $this->data);
    }

    public function materials()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.materials');
        $this->view = 'project-finances.ajax.materials';

        return view('project-finances.index', $this->data);
    }

    public function finishes()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.finishes');
        $this->view = 'project-finances.ajax.finishes';

        return view('project-finances.index', $this->data);
    }

    public function plumbing()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.plumbing');
        $this->view = 'project-finances.ajax.plumbing';

        return view('project-finances.index', $this->data);
    }

    public function wiring()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.wiring');
        $this->view = 'project-finances.ajax.wiring';

        return view('project-finances.index', $this->data);
    }

    public function kitchens()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.kitchens');
        $this->view = 'project-finances.ajax.kitchens';

        return view('project-finances.index', $this->data);
    }

    public function capentry()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.capentry');
        $this->view = 'project-finances.ajax.capentry';

        return view('project-finances.index', $this->data);
    }

    public function metalworking()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.metalworking');
        $this->view = 'project-finances.ajax.metalworking';

        return view('project-finances.index', $this->data);
    }

    public function painting()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.painting');
        $this->view = 'project-finances.ajax.painting';

        return view('project-finances.index', $this->data);
    }

    public function aircon()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.aircon');
        $this->view = 'project-finances.ajax.aircon';

        return view('project-finances.index', $this->data);
    }

    public function waterproofing()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.waterproofing');
        $this->view = 'project-finances.ajax.waterproofing';

        return view('project-finances.index', $this->data);
    }

    public function gardening()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.gardening');
        $this->view = 'project-finances.ajax.gardening';

        return view('project-finances.index', $this->data);
    }

    public function walls()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.walls');
        $this->view = 'project-finances.ajax.walls';

        return view('project-finances.index', $this->data);
    }

    public function additionalCosts()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.additionalCosts');
        $this->view = 'project-finances.ajax.additionalCosts';

        return view('project-finances.index', $this->data);
    }

    public function otherCosts()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.otherCosts');
        $this->view = 'project-finances.ajax.otherCosts';

        return view('project-finances.index', $this->data);
    }

    public function operation()
    {
        $this->pageTitle = 'Project Finances - '.__('modules.projects.tabs.operation');
        $this->view = 'project-finances.ajax.operation';

        return view('project-finances.index', $this->data);
    }
}
