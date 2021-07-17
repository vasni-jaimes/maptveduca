<?php

namespace App\Http\Middleware;
use App\Course;
use Closure;
use DB;
use App\Helpers\Helper;

class ValidarAulaVirtual
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

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
            $trimestreUser = $this->helper->istrimestre( auth()->user()->id );

            $tablero = DB::table('tablero_cursos')
                        ->join('recomendaciones', 'tablero_cursos.curso_id', 'recomendaciones.curso_id')
                        ->where('tablero_cursos.curso_id', $curso->id)
                        ->where('tablero_cursos.user_id', auth()->user()->id)
                        ->where('recomendaciones.trimestre', $trimestreUser)
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
