<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plumbing extends Model
{
    use HasFactory;

    protected $table = 'project_finances_plumbing';

    protected $guarded = ['id'];
}
