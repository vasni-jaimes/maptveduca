<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use App\Http\Requests\ValidarPublicacionAulasMaestro;
use App\Course;
use App\Grupo;
use App\Publicacion;
use App\Respuesta;
use App\Notificacion;
use DB;

class AulasVirtualesController extends Controller
{
	protected $helper;

    public function __construct(Helper $helper)
    {
    	$this->helper = $helper;
        $this->middleware("authadmin:auth");
    }


    public function eliminarArchivoResp(Request $request)
    {
        if (!$request->has('archivo') || !isset($request->archivo)) {
            return response()->json(['message' => 'error_parameter']);
        }

        if (!$request->has('respuesta') || !isset($request->respuesta)) {
            return response()->json(['message' => 'error_parameter']);
        }

        if (!is_numeric($request->archivo) || !is_numeric($request->respuesta)) {
           return response()->json(['message' => 'parameter_invalid']);
        }

        DB::beginTransaction();
        $respuesta = Respuesta::where('id', $request->respuesta)->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();

        if ($respuesta) {

            if ($respuesta->archivos != null) {
                
                $archivosResp    = json_decode($respuesta->archivos);
                $nuevoArrayFiles = array();
                //RECORRER ARRAY DE ARCHIVOS PARA IDENTIFICAR EL QUE SE VA A ELIMINAR
                for ($i=0; $i <= count($archivosResp) - 1; $i++) {
                    if ($i == $request->archivo) {
                        $this->eliminarImagen($archivosResp[$i]);
                    }
                    else {
                        $nuevoArrayFiles[] = $archivosResp[$i];
                    }
                }

                $saveArrayFiles = json_encode($nuevoArrayFiles);
                $respuesta->archivos = $saveArrayFiles;

                if ($respuesta->save()) {
                     DB::commit();
                    return response()->json(['message' => 'ok']);
                }
            }

            DB::rollback();
            return response()->json(['message' => 'error']);
        }

        DB::rollback();
        return response()->json(['message' => 'error']);
    }

    public function eliminarArchivo(Request $request)
    {
        if (!$request->has('archivo') || !isset($request->archivo)) {
            return response()->json(['message' => 'error_parameter']);
        }

        if (!$request->has('publicacion') || !isset($request->publicacion)) {
            return response()->json(['message' => 'error_parameter']);
        }

        if (!is_numeric($request->archivo) || !is_numeric($request->publicacion)) {
           return response()->json(['message' => 'parameter_invalid']);
        }

        DB::beginTransaction();
        $publicacion = Publicacion::where('id', $request->publicacion)
                            ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)->first();


        if ($publicacion) {
            if ($publicacion->archivos != null) {
                $archivosResp    = json_decode($publicacion->archivos);
                $nuevoArrayFiles = array();
                 //RECORRER ARRAY DE ARCHIVOS PARA IDENTIFICAR EL QUE SE VA A ELIMINAR
                for ($i=0; $i <= count($archivosResp) - 1; $i++) {
                    if ($i == $request->archivo) {
                        $this->eliminarImagen($archivosResp[$i]);
                    }
                    else {
                        $nuevoArrayFiles[] = $archivosResp[$i];
                    }
                }

                $saveArrayFiles = json_encode($nuevoArrayFiles);
                $publicacion->archivos = $saveArrayFiles;

                if ($publicacion->save()) {
                    DB::commit();
                    return response()->json(['message' => 'ok']);
                }

                DB::rollback();
                return response()->json(['message' => 'error']);
            }

            DB::rollback();
            return response()->json(['message' => 'error']);
        }


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


    public function indexGrupos($slug_materia)
    {
        $helper = $this->helper;
        $grupos = Grupo::with('usuarios')->get();
        
        return view('admin.listado-grupos-aulas', compact('grupos', 'helper', 'slug_materia'));
    }


    public function create($slug, $grupo_slug)
    {
    	$curso         = Course::where('slug', $slug)->where('status', 1)->first();
        $grupo         = Grupo::where('slug', $grupo_slug)->first();

        $publicaciones = Publicacion::with(['instructor'])  
                            ->where('curso_id', $curso->id)->where('grupo_id', $grupo->id)->orderBy('id', 'desc')->get();
        $respuestas    = Respuesta::with(['usuario', 'instructor'])->get();

        return view('admin.aula-virtual', compact("curso", "publicaciones", "respuestas", "grupo_slug"));
    }


    public function respuestaStore(Request $request, $publicacion_id)
    {
        if (!isset($publicacion_id)) {
            return back()->with("status.newRespuesta", "error");
        }

        if (!$request->has("publicaciontxt") || !isset($request->publicaciontxt)) {
            return back()->with("status.newRespuesta.campo", "error");
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
                                    ->storeAs('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta->id.'/', $request->file('archivos_aula')[$i]->getClientOriginalName());
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


    public function store(ValidarPublicacionAulasMaestro $request, $slug_curso, $grupo_slug)
    {
        if (!isset($slug_curso)) {
            return back()->with("status.newAula", "error");
        }

        $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();
        if ($curso) {

            $grupo = Grupo::where('slug', $grupo_slug)->first();

            DB::beginTransaction();
            $publicacion                = new Publicacion();
            $publicacion->curso_id      = $curso->id;
            $publicacion->instructor_id = Auth::guard('admins')->user()->instructor_id;
            $publicacion->publicacion   = $request->publicaciontxt;
            $publicacion->nombre        = $request->titulo;
            $publicacion->grupo_id      = $grupo->id;

            if ($publicacion->save()) {
                if ( $request->hasFile('archivos_aula') ) {
                    //SUBIR ARCHIVO DE AULA
                    $archivos = array();
                    for ($i=0; $i <= count($request->archivos_aula) - 1; $i++) { 
                        $rootFile = $request->file('archivos_aula')[$i]->storeAs('public/aulas/'.$curso->id.'/'.$publicacion->id.'/publicacion/', $request->file('archivos_aula')[$i]->getClientOriginalName());
                        $archivos[] = $rootFile;
                    }

                    $objArchivos = json_encode($archivos);
                    $publicacion->archivos = $objArchivos;
                    if ($publicacion->save()) {
                        DB::commit();
                        $this->sendNotificaciones($curso);
                        return back()->with("status.newAula", "success");
                    }
                    DB::rollback();
                    return back()->with("status.newAula", "error");
                }
                DB::commit();
                $this->sendNotificaciones($curso);
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

                //return $respuestas;

                if ($respuestas->count() > 0) {

                    foreach ($respuestas as $respuesta) {
                        $respuesta->delete();
                    }

                   // if ($respuestas->delete()) {
                        if ($publicacion->delete()) {
                            DB::commit();
                            return back()->with("status.deletePublicacion", "success");
                        }
                        DB::rollback();
                        return back()->with("status.deletePublicacion", "error");
                        //return "b";
                    //}
                    // DB::rollback();
                    // return back()->with("status.deletePublicacion", "error");
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
                    
                    //ARCHIVOS VIEJOS
                    if ($publicacion->archivos != null) {
                        $objArchivos = json_decode($publicacion->archivos);
                        //RECORRER LOS VIEJOS ARCHIVOS
                        for ($i=0; $i <= count($objArchivos) - 1; $i++) { 
                            $archivos[] = $objArchivos[$i];
                        }
                    }


                    //RECORRER LOS NUEVOS ARCHIVOS
                    $statusFile = false;
                    $miFile     = "";
                    for ($j=0; $j <= count($request->archivos_aula) - 1; $j++) { 

                        $exists = Storage::exists('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/publicacion/'.$request->file('archivos_aula')[$j]->getClientOriginalName());

                        if ($exists) {
                            $statusFile = true;
                            $miFile    .= $request->file('archivos_aula')[$j]->getClientOriginalName().", ";
                        }
                        else {
                            $rootFile = $request->file('archivos_aula')[$j]
                                            ->storeAs('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/publicacion/', $request->file('archivos_aula')[$j]->getClientOriginalName());
                            $archivos[] = $rootFile;
                        }
                    }

                    $arrayArchivos          = json_encode($archivos);
                    $publicacion->archivos  = $arrayArchivos;
                    if ($publicacion->save()) {

                        if ($statusFile) {
                            DB::commit();
                            return back()->with("status.fileExist", $miFile);
                        }

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

        if (!isset($publicacion_id) || !isset($respuesta_id)) {
            return back()->with("status.updateRespuesta", "error");
        }

        if (!isset($request->publicaciontxt) || !$request->has('publicaciontxt')) {
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

                        //ARCHIVOS VIEJOS
                        if ($respuesta->archivos != null) {
                            $objArchivos = json_decode($respuesta->archivos);
                            //RECORRER LOS VIEJOS ARCHIVOS
                            for ($i=0; $i <= count($objArchivos) - 1; $i++) { 
                                $archivos[] = $objArchivos[$i];
                            }
                        }

                        
                        //RECORRER LOS NUEVOS ARCHIVOS
                        $statusFile = false;
                        $miFile     = "";
                        for ($j=0; $j <= count($request->archivos_aula) - 1; $j++) { 

                            $exists = Storage::exists('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/'.$request->file('archivos_aula')[$j]->getClientOriginalName());

                            if ($exists) {
                                $statusFile = true;
                                $miFile    .= $request->file('archivos_aula')[$j]->getClientOriginalName().", ";
                            }
                            else {

                                $rootFile = $request->file('archivos_aula')[$j]
                                                ->storeAs('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/', $request->file('archivos_aula')[$j]->getClientOriginalName());
                                $archivos[] = $rootFile;
                            }
                        }

                        $arrayArchivos          = json_encode($archivos);
                        $respuesta->archivos  = $arrayArchivos;
                        if ($respuesta->save()) {

                            if ($statusFile) {
                                DB::commit();
                                return back()->with("status.fileExist", $miFile);
                            }

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


    protected function sendNotificaciones($curso)
    {
        $alumnos    = DB::table('tablero_cursos')->where('curso_id', $curso->id)->get();
        $profesor   = DB::table('courses_instructors')->where('course_id', $curso->id)->first();
        $profesorTitular   = DB::table('instructors')->where('id', $profesor->instructor_id)->first();


        foreach ($alumnos as $alumno) {
           $notificacion = new Notificacion();
            $notificacion->user_id = $alumno->user_id;
            $notificacion->mensaje = "¡Se ha publicado una nueva actividad!
                                        El profesor ".$profesorTitular->nombres." ".$profesorTitular->apellidos." ha publicado una nueva actividad en el Aula Virtual de <br>
                                        la materia ".$curso->nombre." Da click aquí para verla: <a href='".route('aula-virtual.show', $curso->slug)."'>".$curso->nombre."</a>";
            $notificacion->save();
        }
    }
}
