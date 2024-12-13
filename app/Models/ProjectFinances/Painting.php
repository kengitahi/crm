<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Painting extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\Painting";

    protected $table = 'project_finances_painting';

    protected $guarded = ['id'];
}
