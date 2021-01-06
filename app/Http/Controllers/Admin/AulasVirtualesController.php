<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Course;
use App\Publicacion;
use App\Respuesta;
use DB;

class AulasVirtualesController extends Controller
{
	protected $helper;

    public function __construct(Helper $helper)
    {
    	$this->helper = $helper;
        $this->middleware("authadmin:auth");
    }


    public function index()
    {
    	$helper = $this->helper;
    	$materias = DB::table('courses_instructors')
    					->join('courses', 'courses_instructors.course_id', 'courses.id')
    					->where('instructor_id', Auth::guard('admins')->user()->instructor_id)
    					->where('courses.status', 1)
    					->get();

    	return view('admin.listado-materias', compact("materias", "helper"));
    }


    public function create($slug)
    {
    	$curso         = Course::where('slug', $slug)->where('status', 1)->first();
        $temario       = json_decode($curso->temario);
        $publicaciones = Publicacion::with(['instructor'])  
                            ->where('curso_id', $curso->id)->get();
        $respuestas    = Respuesta::with(['usuario', 'instructor'])->get();

        return view('admin.aula-virtual', compact("curso", "temario", "publicaciones", "respuestas"));
    }


    public function respuestaStore(Request $request, $publicacion_id)
    {
        if (!$request->has("publicaciontxt") && !isset($request->publicaciontxt)) {
            return back()->with("status.newRespuesta", "error");
        }

        DB::beginTransaction();
        $respuesta = new Respuesta();
        $respuesta->instructor_id = Auth::guard('admins')->user()->instructor_id;
        $respuesta->publicacion_id = $publicacion_id;
        $respuesta->respuesta = $request->publicaciontxt;

        if ($respuesta->save()) {
            if ( $request->hasFile('archivo_aula') ) {
                //SUBIR ARCHIVO DE AULA
                $rootFile = $request->file('archivo_aula')->store('public/aulas/'.$curso->id.'/'.$sesion_id.'/respuestas/');
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


    public function store(Request $request, $slug_curso, $sesion_id)
    {
        if (!$request->has("publicaciontxt") && !isset($request->publicaciontxt)) {
            return back()->with("status.newAula", "error");
        }

        $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();
        if ($curso) {
            DB::beginTransaction();
            $publicacion                = new Publicacion();
            $publicacion->curso_id      = $curso->id;
            $publicacion->session_id    = $sesion_id;
            $publicacion->instructor_id = Auth::guard('admins')->user()->instructor_id;
            $publicacion->publicacion   = $request->publicaciontxt;

            if ($publicacion->save()) {
                if ( $request->hasFile('archivo_aula') ) {
                    //SUBIR ARCHIVO DE AULA
                    $rootFile = $request->file('archivo_aula')->store('public/aulas/'.$curso->id.'/'.$sesion_id.'/publicacion/');
                    $publicacion->archivo = $rootFile;
                    if ($publicacion->save()) {
                        DB::commit();
                        return back()->with("status.newAula", "success");
                    }
                    DB::rollback();
                    return back()->with("status.newAula", "error");
                }
                DB::commit();
                return back()->with("status.newAula", "success");
            }
            DB::rollback();
            return back()->with("status.newAula", "error");
        }
        DB::rollback();
        return back()->with("status.newAula", "error");
    }
}
