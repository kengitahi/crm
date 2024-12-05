<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensesAndPermits extends Model
{
    use HasFactory;

    protected $table = 'project_finances_licenses';

    protected $fillable = [
        'who',
        'cfe',
        'condominium_regime',
        'license_and_alignment',
        'rooms',
        'mobility',
    ];
}
