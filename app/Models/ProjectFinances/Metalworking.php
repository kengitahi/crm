<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metalworking extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\Metalworking";

    protected $table = 'project_finances_metalworking';

    protected $guarded = ['id'];
}
