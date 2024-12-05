<?php

namespace App\Models\ProjectFinances;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensesAndPermits extends Model
{
    use HasFactory;

    protected $table = 'licenses';

    protected $fillable = [
        'who',
        'cfe',
        'condominiumRegime',
        'licenseAndAlignment',
        'rooms',
        'mobility',
    ];
}
