<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanAdminLogin
{
    /**
     * Check that the frontend can register/login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if (! env('MODULE_ADMIN_LOGIN')) {
            return abort(403, 'You are not authorized to access this');
        }

        return $next($request);
    }
}
