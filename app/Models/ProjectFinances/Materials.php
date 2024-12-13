<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\Materials';

    protected $table = 'project_finances_materials';

    protected $guarded = ['id'];
}
