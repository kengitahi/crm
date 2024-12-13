<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plumbing extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\Plumbing';

    protected $table = 'project_finances_plumbing';

    protected $guarded = ['id'];
}
