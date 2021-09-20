<?php

namespace App\Http\Middleware;

use Closure;

class SoloMembresiaAcademica
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->user()->tieneSuscripcion() == true && auth()->user()->ultimaSuscripcion()->id == 2) {
            return $next($request);
        }

        return redirect()->route('micuenta.index');
        
    }
}
