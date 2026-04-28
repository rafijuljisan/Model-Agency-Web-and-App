<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'duration_months' => 'integer',
        'price' => 'decimal:2',
        'max_portfolio_photos' => 'integer',
    ];
}