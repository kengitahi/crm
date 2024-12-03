<?php

namespace App\Http\Controllers;

use App\Models\ProjectFinance;

use App\Models\Project;
use App\Models\User;

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
        $tab = request('tab');
        $this->activeTab = $tab ?: 'preliminary';
        $this->view = 'project-finances.ajax.show';
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
    public function show(ProjectFinance $projectFinance)
    {
        //
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
}
