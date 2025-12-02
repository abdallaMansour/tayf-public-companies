<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IsValidTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isTenantPath = isTenantPath();
        if (!$isTenantPath)
            abort(404);

        $tenantConnectionName = tenantConnectionDatabase();

        if (!$tenantConnectionName)
            abort(404);

        config(['database.default' => $tenantConnectionName]);

        return $next($request);
    }
}
