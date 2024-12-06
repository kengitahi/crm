<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirCon extends Model
{
    use HasFactory;

    protected $table = 'project_finances_aircon';

    // protected $fillable = ["air_conditioning_system"];
    protected $guarded = [
        'id',
    ];
}
