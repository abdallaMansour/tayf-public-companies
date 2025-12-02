<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'sass_businesses';

    protected $fillable = [
        'companyName',
        'email',
        'phoneNumber',
        'address',
        'description',
        'status',
        // 'business_category_id',
        'plan_subscribe_id',
        'user_id',
        'shopOpeningBalance',
        'tenant_id',
        'vat_no',
        'vat_name',
        'will_expire',
        'subscriptionDate',
        'remainingShopBalance',
    ];

    protected $casts = [
        'status' => 'boolean',
        'shopOpeningBalance' => 'decimal:2',
        'remainingShopBalance' => 'decimal:2',
        'will_expire' => 'date',
        'subscriptionDate' => 'datetime',
    ];

    public function isActive()
    {
        return $this->status === true;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function isExpired()
    {
        return $this->will_expire && $this->will_expire->isPast();
    }

    // Relationships
    // public function businessCategory()
    // {
    //     return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    // }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_subscribe_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(DokkanUser::class, 'user_id');
    // }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
