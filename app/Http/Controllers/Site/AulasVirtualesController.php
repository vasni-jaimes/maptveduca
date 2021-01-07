<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Publicacion;
use App\Respuesta;
use DB;

class AulasVirtualesController extends Controller
{
 	
 	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ValidarAulaVirtual', ['only' => ['showAula']]);
    }   

    public function showAulas()
    {
    	$materias = DB::table('tablero_cursos')
                            ->join('courses', 'tablero_cursos.curso_id', 'courses.id')
                            ->select('courses.*')
                            ->where('courses.status', 1)
                            ->where('tablero_cursos.user_id', auth()->user()->id)
                            ->get();

    	return view('site.aulas', compact("materias"));
    }


    public function showAula($slug)
    {
    	$curso         = Course::where('slug', $slug)->where('status', 1)->first();
        $temario       = json_decode($curso->temario);
        $publicaciones = Publicacion::with(['instructor'])  
                            ->where('curso_id', $curso->id)->get();
        $respuestas    = Respuesta::with(['usuario', 'instructor'])->get();

    	return view('site.single-aulas', compact("curso", "temario", "publicaciones", "respuestas"));
    }


    public function respuestaStore(Request $request, $publicacion_id)
    {
        if (!$request->has("publicaciontxt") && !isset($request->publicaciontxt)) {
            return back()->with("status.newRespuesta", "error");
        }

        DB::beginTransaction();
        $respuesta = new Respuesta();
        $respuesta->user_id = auth()->user()->id;
        $respuesta->publicacion_id = $publicacion_id;
        $respuesta->respuesta = $request->publicaciontxt;

        if ($respuesta->save()) {
            if ( $request->hasFile('upload') ) {
                //SUBIR ARCHIVO DE AULA
                $rootFile = $request->file('upload')->store('public/aulas/'.$curso->id.'/'.$sesion_id.'/respuestas/');
                $respuesta->archivo = $rootFile;
                if ($respuesta->save()) {
                    DB::commit();
                    return back()->with("status.newRespuesta", "success");
                }
                DB::rollback();
                return back()->with("status.newRespuesta", "error");
            }
            DB::commit();
            return back()->with("status.newRespuesta", "success");
        }
        DB::rollback();
        return back()->with("status.newRespuesta", "error");
    }
}
