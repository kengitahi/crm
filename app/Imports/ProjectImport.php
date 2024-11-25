<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

class ProjectImport implements ToArray
{
    public static function fields(): array
    {
        return [
            ['id' => 'project_name', 'name' => __('modules.projects.projectName'), 'required' => 'Yes'],
            ['id' => 'project_summary', 'name' => __('modules.projects.projectSummary'), 'required' => 'No'],
            ['id' => 'start_date', 'name' => __('modules.projects.startDate'), 'required' => 'Yes'],
            ['id' => 'deadline', 'name' => __('modules.projects.deadline'), 'required' => 'No'],
            ['id' => 'client_email', 'name' => __('app.client').' '.__('app.email'), 'required' => 'No'],
            ['id' => 'project_budget', 'name' => __('modules.projects.projectBudget'), 'required' => 'No'],
            ['id' => 'status', 'name' => __('app.status'), 'required' => 'No'],
            ['id' => 'notes', 'name' => __('modules.projects.note'), 'required' => 'No'],
        ];
    }

    public function array(array $array): array
    {
        return $array;
    }
}
