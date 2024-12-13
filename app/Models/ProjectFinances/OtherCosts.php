<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCosts extends Model
{
    use HasFactory;

    protected $table = 'project_finances_other_costs';

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\OtherCosts";

    protected $guarded = ['id'];
}
