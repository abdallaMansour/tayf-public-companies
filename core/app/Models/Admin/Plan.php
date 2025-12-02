<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'sass_plans';

    protected $fillable = [
        'status',
        'duration',
        'offerPrice',
        'subscriptionName',
        'subscriptionPrice',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
        'status' => 'boolean',
        'offerPrice' => 'decimal:2',
        'subscriptionPrice' => 'decimal:2',
        'duration' => 'integer',
    ];
}





