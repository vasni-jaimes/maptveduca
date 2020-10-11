<?php

namespace App\Http\Middleware;

use Closure;
use App\Clase;
use Illuminate\Http\Request;

class ValidarIdClase
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
        if ($request->clase_id) {    
            $clase = Clase::where("slug", $request->clase_id)->where("status", 1)->first();

            if ($clase == false) {
                return redirect()->route("clases-linea.index");
            }

            return $next($request);
        }

        return redirect()->route("clases-linea.index");        
    }
}
