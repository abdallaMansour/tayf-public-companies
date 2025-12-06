<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'username',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}

