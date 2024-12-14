<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterproofing extends Model
{
    use HasFactory;

    protected $table = 'project_finances_waterproofing';

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\Waterproofing";

    protected $guarded = ['id'];
}
