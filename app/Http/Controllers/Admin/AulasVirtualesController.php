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
        if (!isset($publicacion_id)) {
            return back()->with("status.newRespuesta", "error");
        }

        if (!$request->has("publicaciontxt") && !isset($request->publicaciontxt)) {
            return back()->with("status.newRespuesta", "error");
        }

        //OBTENER PUBLICACION CON CURSO
        $publicacion = Publicacion::where('id', $publicacion_id)->first();
        if (!$publicacion) {
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
                                    ->store('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta->id);
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
        if (!isset($slug_curso)) {
            return back()->with("status.newAula", "error");
        }

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


    public function eliminarPost($publicacion_id)
    {
        if (isset($publicacion_id)) {
            
            $publicacion = Publicacion::where('id', $publicacion_id)
                            ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();

            if ($publicacion) {
                DB::beginTransaction();

                $carpeta = 'public/aulas/'.$publicacion->curso_id.'/'.$publicacion->id.'/';
                $this->eliminarCarpeta($carpeta);

                $respuestas = Respuesta::where('publicacion_id', $publicacion_id)->get();
                if ($respuestas->count() > 0) {
                    if ($respuestas->delete()) {
                        if ($publicacion->delete()) {
                            DB::commit();
                            return back()->with("status.deletePublicacion", "success");
                        }
                        DB::rollback();
                        return back()->with("status.deletePublicacion", "error");
                        //return "b";
                    }
                    DB::rollback();
                    return back()->with("status.deletePublicacion", "error");
                    //return "d";
                }
                
                if ($publicacion->delete()) {
                    DB::commit();
                    return back()->with("status.deletePublicacion", "success");
                }
                DB::rollback();
                return back()->with("status.deletePublicacion", "error");
                //return "c";
            }
            DB::rollback();
            return back()->with("status.deletePublicacion", "error");
            //return "v";
        }
        DB::rollback();
        return back()->with("status.deletePublicacion", "error");
        //return "q";
    }


    public function eliminarRespuesta($respuesta_id)
    {
        if (isset($respuesta_id)) {
            
            //$respuesta = Respuesta::where('id', $respuesta_id)->where('user_id', auth()->user()->id)->first();
            $respuesta = Respuesta::where('id', $respuesta_id)->first();
            if ($respuesta) {

                //ELIMINAR ARCHIVOS ADDJUNTOS DE LA RESPUESTA
                $publicacion = Publicacion::where('id', $respuesta->publicacion_id)->first();
                $carpeta     = 'public/aulas/'.$publicacion->curso_id.'/'.$publicacion->id.'/respuestas/'.$respuesta_id.'/';
                $this->eliminarCarpeta($carpeta);

                // ELIMINAR RESPUESTA DE LA BASE
                DB::beginTransaction();
                if ($respuesta->delete()) {
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


    public function updatePublicidad(Request $request, $publicacion_id)
    {
        if (!isset($publicacion_id)) {
            return back()->with("status.updatePublicidad", "error");
        }

        if (!$request->has('publicaciontxt') && !isset($request->publicaciontxt)) {
            return back()->with("status.updatePublicidad", "error");
        }

        $publicacion = Publicacion::where('id', $publicacion_id)
                            ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();

        DB::beginTransaction();
        if ($publicacion) {
            $publicacion->publicacion = $request->publicaciontxt;

            if ( $publicacion->save() ) {
                if ( $request->hasFile('archivos_aula') ) {
                    $archivos    = array();
                    // if ($publicacion->archivos != null) {
                    //     $objArchivos = json_decode($publicacion->archivos);
                    //     //RECORRER LOS VIEJOS ARCHIVOS
                    //     for ($i=0; $i <= count($objArchivos) - 1; $i++) { 
                    //         $archivos[] = $objArchivos[$i];
                    //     }
                    // }

                    //ELIMINAR ARCHIVOS ANTERIORES
                    $carpeta     = 'public/aulas/'.$publicacion->curso_id.'/'.$publicacion->id.'/publicacion/';
                    $this->eliminarCarpeta($carpeta);

                    //RECORRER LOS NUEVOS ARCHIVOS
                    for ($j=0; $j <= count($request->archivos_aula) - 1; $j++) { 
                        $rootFile = $request->file('archivos_aula')[$j]
                                            ->store('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/publicacion/');
                        $archivos[] = $rootFile;
                    }

                    $arrayArchivos          = json_encode($archivos);
                    $publicacion->archivos  = $arrayArchivos;
                    if ($publicacion->save()) {
                        DB::commit();
                        return back()->with("status.updatePublicidad", "success");
                    }

                    DB::rollback();
                    return back()->with("status.updatePublicidad", "error");
                }

                DB::commit();
                return back()->with("status.updatePublicidad", "success");
            }

            DB::rollback();
            return back()->with("status.updatePublicidad", "error");
        }
        DB::rollback();
        return back()->with("status.updatePublicidad", "error");
    }


    public function updateRespuesta(Request $request, $publicacion_id, $respuesta_id)
    {

        if (!isset($publicacion_id) && !isset($respuesta_id)) {
            return back()->with("status.updateRespuesta", "error");
        }

        $publicacion = Publicacion::where('id', $publicacion_id)
                            ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();

        DB::beginTransaction();
        if ($publicacion) {
            $respuesta = Respuesta::where('id', $respuesta_id)
                            ->where('publicacion_id', $publicacion_id)
                            ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();

            if ($respuesta) {
                $respuesta->respuesta = $request->publicaciontxt;
                if ($respuesta->save()) {
                    if ( $request->hasFile('archivos_aula') ) {
                        $archivos    = array();
                        // if ($respuesta->archivos != null) {
                        //     $objArchivos = json_decode($respuesta->archivos);
                        //     //RECORRER LOS VIEJOS ARCHIVOS
                        //     for ($i=0; $i <= count($objArchivos) - 1; $i++) { 
                        //         $archivos[] = $objArchivos[$i];
                        //     }
                        // }
                        

                        //ELIMINAR ARCHIVOS
                        $carpeta     = 'public/aulas/'.$publicacion->curso_id.'/'.$publicacion->id.'/respuestas/'.$respuesta_id.'/';
                        $this->eliminarCarpeta($carpeta);

                        
                        //RECORRER LOS NUEVOS ARCHIVOS
                        for ($j=0; $j <= count($request->archivos_aula) - 1; $j++) { 
                            $rootFile = $request->file('archivos_aula')[$j]
                                                ->store('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/');
                            $archivos[] = $rootFile;
                        }

                        $arrayArchivos          = json_encode($archivos);
                        $respuesta->archivos  = $arrayArchivos;
                        if ($respuesta->save()) {
                            DB::commit();
                            return back()->with("status.updateRespuesta", "success");
                        }

                        DB::rollback();
                        return back()->with("status.updateRespuesta", "error");
                    }
                    DB::commit();
                    return back()->with("status.updateRespuesta", "success");
                }
                DB::rollback();
                return back()->with("status.updateRespuesta", "error");
            }
            DB::rollback();
            return back()->with("status.updateRespuesta", "error");
        }
        DB::rollback();
        return back()->with("status.updateRespuesta", "error");
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


    protected function eliminarCarpeta($file)
    {
        return \Storage::deleteDirectory($file);
    }
}
