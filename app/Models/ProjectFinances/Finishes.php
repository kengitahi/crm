<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finishes extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\Finishes';

    protected $table = 'project_finances_finishes';

    protected $guarded = ['id'];
}
