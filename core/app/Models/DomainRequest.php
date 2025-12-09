<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainRequest extends Model
{
    protected $table = 'domains';

    use HasFactory;

    protected $fillable = [
        'domain',
        'username',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}

