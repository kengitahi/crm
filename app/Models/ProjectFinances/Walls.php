<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walls extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\Walls";

    protected $table = 'project_finances_prefabricated_walls';

    protected $guarded = ['id'];
}
