<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_MODEL = "App\Models\ProjectFinances\Operation";

    protected $table = 'project_finances_operation';

    protected $guarded = ['id'];
}
