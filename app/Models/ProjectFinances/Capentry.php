<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capentry extends Model
{
    use HasFactory;

    protected $table = 'project_finances_capentry';

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\Capentry';

    protected $guarded = ['id'];
}
