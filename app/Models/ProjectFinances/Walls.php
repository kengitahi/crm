<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walls extends Model
{
    use HasFactory;

    protected $table = 'project_finances_prefabricated_walls';

    protected $guarded = ['id'];
}
