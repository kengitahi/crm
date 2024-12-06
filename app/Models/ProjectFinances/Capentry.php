<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capentry extends Model
{
    use HasFactory;

    protected $table = 'project_finances_capentry';

    protected $guarded = ['id'];
}
