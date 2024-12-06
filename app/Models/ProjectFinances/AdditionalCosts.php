<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalCosts extends Model
{
    use HasFactory;

    protected $table = 'project_finances_additional_costs';

    protected $guarded = ['id'];
}
