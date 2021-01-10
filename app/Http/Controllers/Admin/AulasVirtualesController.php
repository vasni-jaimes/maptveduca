<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $publicaciones = Publicacion::with(['instructor'])  
                            ->where('curso_id', $curso->id)->orderBy('id', 'desc')->get();
        $respuestas    = Respuesta::with(['usuario', 'instructor'])->get();

        return view('admin.aula-virtual', compact("curso", "publicaciones", "respuestas"));
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
            if ( $request->hasFile('archivos_aula') ) {
                //SUBIR ARCHIVO DE AULA
                $archivos = array();
                for ($i=0; $i <= count($request->archivos_aula) - 1; $i++) { 
                    $rootFile = $request->file('archivos_aula')[$i]
                                    ->store('public/aulas/'.$curso->id.'/'.$sesion_id.'/respuestas/'.$respuesta->id);
                    $archivos[] = $rootFile;
                }
                
                $objArchivos = json_encode($archivos);
                $respuesta->archivos = $objArchivos;
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


    public function store(Request $request, $slug_curso)
    {
        if (!$request->has("publicaciontxt") && !isset($request->publicaciontxt) && !$request->has("titulo")) {
            return back()->with("status.newAula", "error");
        }

        $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();
        if ($curso) {
            DB::beginTransaction();
            $publicacion                = new Publicacion();
            $publicacion->curso_id      = $curso->id;
            $publicacion->instructor_id = Auth::guard('admins')->user()->instructor_id;
            $publicacion->publicacion   = $request->publicaciontxt;
            $publicacion->nombre        = $request->titulo;

            if ($publicacion->save()) {
                if ( $request->hasFile('archivos_aula') ) {
                    //SUBIR ARCHIVO DE AULA
                    $archivos = array();
                    for ($i=0; $i <= count($request->archivos_aula) - 1; $i++) { 
                        $rootFile = $request->file('archivos_aula')[$i]->store('public/aulas/'.$curso->id.'/'.$publicacion->id.'/publicacion/');
                        $archivos[] = $rootFile;
                    }

                    $objArchivos = json_encode($archivos);
                    $publicacion->archivos = $objArchivos;
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


    public function eliminarRespuesta($respuesta_id)
    {
        if (isset($respuesta_id)) {
            
            $respuesta = Respuesta::where('id', $respuesta_id)->where('user_id', auth()->user()->id)->first();
            if ($respuesta) {

                $archivos = json_decode($respuestas->archivos);
                for ($i=0; $i <= count($archivos) - 1; $i++) { 
                    $this->eliminarImagen($archivos[$i]);
                }

                DB::beginTransaction();

                if ($respuestas->delete()) {
                    DB::commit();
                    return back()->with("status.deleteRespuesta", "success");
                }

                DB::rollback();
                return back()->with("status.deleteRespuesta", "error");
            }

            DB::rollback();
            return back()->with("status.deleteRespuesta", "error");
        }

        DB::rollback();
        return back()->with("status.deleteRespuesta", "error");
    }


    public function updateRespuesta(Request $request, $publicacion_id, $respuesta_id)
    {
        return $request;
    }


    public function downloadFile($slug_curso, $publicacion_id, $positionFile)
    {
        $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();
        if ($curso) {
            $publicacion = Publicacion::where('curso_id', $curso->id)
                            ->where('id', $publicacion_id)->first();

            if ($publicacion) {
                $archivos = json_decode($publicacion->archivos);
                for ($i=0; $i <= count($archivos) - 1; $i++) { 
                    if ($positionFile == $i) {
                        if (isset($archivos[$i])) {
                            echo "<script> window.close() </script>";
                            return response()->download(storage_path("app/".$archivos[$i]));
                        }
                    }
                }
            }

            echo "<script> window.close() </script>";
        }

        echo "<script> window.close() </script>";
    }


    public function downloadFileResp($slug_curso, $publicacion_id, $respuesta_id, $positionFile)
    {
        $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();
        if ($curso) {
            $publicacion = Publicacion::where('curso_id', $curso->id)
                            ->where('id', $publicacion_id)->first();

            if ($publicacion) {

                $respuesta = Respuesta::where('publicacion_id', $publicacion_id)
                                ->where('id', $respuesta_id)->first();

                if ($respuesta) {
                    $archivos = json_decode($respuesta->archivos);
                    for ($i=0; $i <= count($archivos) - 1; $i++) { 
                        if ($positionFile == $i) {
                            if (isset($archivos[$i])) {
                                echo "<script> window.close() </script>";
                                return response()->download(storage_path("app/".$archivos[$i]));
                            }
                        }
                    }
                }
                echo "<script> window.close() </script>";
            }

            echo "<script> window.close() </script>";
        }

        echo "<script> window.close() </script>";
    }


    protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }
}
