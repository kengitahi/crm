<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchens extends Model
{
    use HasFactory;

    protected $table = 'project_finances_kitchens';

    protected $guarded = ['id'];
}
