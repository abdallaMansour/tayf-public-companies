<?php

namespace App\Models\Admin;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\DatabaseCredential;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'country_code',
        'is_active',
        'email_verified_at',
        'business_activity_id',
        'category_id',
        'website_lang',
        'dashboard_lang',
        'color_mode'
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function databaseCredential()
    {
        return $this->hasOne(DatabaseCredential::class);
    }

    // public function languages()
    // {
    //     return $this->belongsToMany(Language::class, 'tenant_langs', 'tenant_id', 'language_id');
    // }

    // public function dashboardLanguages()
    // {
    //     return $this->belongsToMany(Language::class, 'tenant_langs', 'tenant_id', 'language_id')->where('is_dashboard', true);
    // }

    // public function themes()
    // {
    //     return $this->belongsToMany(Theme::class, 'tenant_themes', 'tenant_id', 'theme_id')
    //         ->withPivot(['is_active', 'expired_at']);
    // }

    // public function tenantThemes()
    // {
    //     return $this->hasMany(TenantTheme::class);
    // }

    // Dokkan Business/Store relationship
    public function businesses()
    {
        return $this->hasMany(Business::class, 'tenant_id');
    }

    public function businessActivity()
    {
        return $this->belongsTo(BusinessActivity::class, 'business_activity_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Get active business/store
    public function activeBusiness()
    {
        return $this->businesses()
            ->where('status', true)
            ->where(function ($query) {
                $query->whereNull('will_expire')
                    ->orWhere('will_expire', '>', now());
            })
            ->first();
    }

    // Check if tenant has active subscription/store
    public function hasActiveStore()
    {
        return $this->activeBusiness() !== null;
    }

    // Check if tenant has any store (regardless of subscription status)
    public function hasStore()
    {
        return $this->businesses()->exists();
    }
}
