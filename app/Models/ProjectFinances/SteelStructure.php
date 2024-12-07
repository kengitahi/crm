<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SteelStructure extends Model
{
    use HasFactory;

    protected $table = 'project_finances_steel';

    protected $guarded = ['id'];
}
