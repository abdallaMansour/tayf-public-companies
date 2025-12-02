<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BusinessActivity extends Model
{
    protected $table = "business_activities";

    public $timestamps = false;

    protected $fillable = [
        'name',
        'is_active'
    ];

    // public function requirements()
    // {
    //     return $this->hasMany(BusinessActivityRequirement::class);
    // }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
