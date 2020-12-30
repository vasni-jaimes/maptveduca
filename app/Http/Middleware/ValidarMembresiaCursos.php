<?php

namespace App\Http\Middleware;

use Closure;

class ValidarMembresiaCursos
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
        if (auth()->user()->tieneSuscripcion() == false && $request->clase_id != null) {
            return redirect()->route('single-cursos.show', $request->curso_id);
        }

        return $next($request);
    }
}
