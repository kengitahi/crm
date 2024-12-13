<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensesAndPermits extends Model
{
    use HasFactory;

    protected $table = 'project_finances_licenses';

    const CUSTOM_FIELD_MODEL = 'App\Models\ProjectFinances\LicensesAndPermits';

    protected $guarded = ['id'];
}
