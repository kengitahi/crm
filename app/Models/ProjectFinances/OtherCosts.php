<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCosts extends Model
{
    use HasFactory;

    protected $table = 'project_finances_other_costs';

    protected $guarded = ['id'];
}
