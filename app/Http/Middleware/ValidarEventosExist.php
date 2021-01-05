<?php

namespace App\Http\Middleware;

use Closure;
use App\Evento;

class ValidarEventosExist
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

        $evento = Evento::with(["instructor"])->where("slug", $request->evento_id)->first();

        if ($evento) {
            return $next($request);
        }

        return redirect()->route('eventos.index');
    }
}
