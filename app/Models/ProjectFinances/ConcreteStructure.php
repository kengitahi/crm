<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcreteStructure extends Model
{
    use HasFactory;

    protected $table = 'project_finances_concrete_structure';

    protected $guarded = ['id'];
}
