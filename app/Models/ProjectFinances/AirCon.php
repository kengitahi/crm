<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirCon extends Model
{
    use HasFactory;

    protected $table = 'project_finances_aircon';

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\AirCon';

    protected $guarded = [
        'id',
    ];
}
