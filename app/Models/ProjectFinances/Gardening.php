<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gardening extends Model
{
    use HasFactory;

    protected $table = 'project_finances_gardening';

    protected $guarded = ['id'];
}
