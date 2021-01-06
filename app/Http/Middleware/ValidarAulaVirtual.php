<?php

namespace App\Http\Middleware;
use App\Course;
use Closure;
use DB;

class ValidarAulaVirtual
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
        $curso = Course::where('slug', $request->user_id)->where('status', 1)->first();
        if ($curso) {
            $tablero = DB::table('tablero_cursos')
                        ->where('curso_id', $curso->id)
                        ->where('user_id', auth()->user()->id)
                        ->first();

            if ($tablero) {
                return $next($request);
            }

            return redirect()->route('aulas-virtuales.show');
        }
        
        return redirect()->route('aulas-virtuales.show');
        //return $next($request);
    }
}
