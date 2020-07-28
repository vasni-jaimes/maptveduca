<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $auth)
    {
        if ($auth == "auth") { 
            if (Auth::guard('admins')->check()) {
                return $next($request);
            }

            return redirect()->route("admin.login");
        }
        else if ($auth == "guest") {
            if (!Auth::guard('admins')->check()) {
                return $next($request);
            }

            return redirect()->route("dashboard");
        }
    }
}
