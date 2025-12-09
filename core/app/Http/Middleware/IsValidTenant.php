<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\DomainRequest;

class IsValidTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant_username = isTenantPath();
        if (!$tenant_username)
            abort(404);

        $admin_connection = adminConnectionDatabase();

        $domain = DomainRequest::on($admin_connection)->where('username', $tenant_username)->active()->first();

        if ($domain) {
            $domainUrl = $domain->domain;
            // Add protocol if not present
            if (!Str::startsWith($domainUrl, ['http://', 'https://'])) {
                // Use https by default, or http in local environment
                $protocol = $request->secure() || !app()->environment('local') ? 'https://' : 'http://';
                $domainUrl = $protocol . $domainUrl;
            }
            return redirect()->away($domainUrl);
        }

        $tenantConnectionName = tenantConnectionDatabase();

        if (!$tenantConnectionName)
            abort(404);

        config(['database.default' => $tenantConnectionName]);

        return $next($request);
    }
}
