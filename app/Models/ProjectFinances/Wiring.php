<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiring extends Model
{
    use HasFactory;

    protected $table = 'project_finances_wiring';

    protected $guarded = ['id'];
}
