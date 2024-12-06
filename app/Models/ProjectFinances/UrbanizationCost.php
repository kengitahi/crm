<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrbanizationCost extends Model
{
    use HasFactory;

    protected $table = 'project_finances_urbanization';

    // protected $fillable = ["urbanization_suppliers"];
    protected $guarded = ['id'];
}
