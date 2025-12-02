<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DatabaseCredential extends Model
{
    protected $table = "database_credentials";

    protected $fillable = [
        'db_name',
        'db_user', 
        'db_password',
        'tenant_id'
    ];

    /**
     * Scope to get only active credentials
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('tenant_id');
    }

    /**
     * Scope to get only inactive credentials
     */
    public function scopeInactive($query)
    {
        return $query->whereNull('tenant_id');
    }

    // Relationships
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
