<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrayMasonryWork extends Model
{
    use HasFactory;

    protected $table = 'project_finances_masonry_work';

    protected $guarded = ['id'];
}
