<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Course;
use App\Publicacion;
use App\Respuesta;
use DB;
use App\Helpers\Helper;

class AulasVirtualesController extends Controller
{

    protected $helper;
 	
 	public function __construct(Helper $helper)
    {
        $this->middleware('auth');
        $this->middleware('ValidarAulaVirtual', ['only' => ['showAula']]);
        $this->helper = $helper;
    }


    public function eliminarArchivo(Request $request)
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

        $respuesta = Respuesta::where('id', $request->respuesta)->where('user_id', auth()->user()->id)->first();

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

    public function showAulas()
    {
        $trimestreUser = $this->helper->istrimestre( auth()->user()->id );
    	$materias = DB::table('tablero_cursos')
                            ->join('courses', 'tablero_cursos.curso_id', 'courses.id')
                            ->join('recomendaciones', 'courses.id', 'recomendaciones.curso_id')
                            ->select('courses.*')
                            ->where('courses.status', 1)
                            ->where('tablero_cursos.user_id', auth()->user()->id)
                            ->where('recomendaciones.trimestre', $trimestreUser)
                            ->get();

    	return view('site.aulas', compact("materias"));
    }


    public function showAula($slug)
    {
        $grupo         = auth()->user()->grupo_id;
    	$curso         = Course::where('slug', $slug)->where('status', 1)->first();
        $publicaciones = Publicacion::with(['instructor'])->where('curso_id', $curso->id)->where('grupo_id', $grupo)->orderBy('created_at', 'desc')->get();
        $respuestas    = Respuesta::with(['usuario', 'instructor'])->orderBy('created_at', 'desc')->get();

    	return view('site.single-aulas', compact("curso", "publicaciones", "respuestas"));
    }


    public function respuestaStore(Request $request, $publicacion_id)
    {
        if (!$request->has("publicaciontxt") || !isset($request->publicaciontxt)) {
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
                $curso = Publicacion::where('id', $publicacion_id)->first();
                if (!$curso) {
                    DB::rollback();
                    return back()->with("status.newRespuesta", "error");
                }

                $archivos = array();
                for ($i=0; $i <= count($request->upload) - 1; $i++) {
                    $rootFile = $request->file('upload')[$i]
                                    ->storeAs('public/aulas/'.$curso->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta->id, $request->file('upload')[$i]->getClientOriginalName());

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


    public function downloadFileProfe($slug_curso, $publicacion_id, $positionFile)
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


    public function downloadFile($slug_curso, $publicacion_id, $respuesta_id, $positionFile)
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


    public function eliminarRespuesta($respuesta_id)
    {
        if (isset($respuesta_id)) {
            
            //$respuesta = Respuesta::where('id', $respuesta_id)->where('user_id', auth()->user()->id)->first();
            $respuesta = Respuesta::where('id', $respuesta_id)->where('user_id', auth()->user()->id)->first();
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


    public function updateRespuesta(Request $request, $publicacion_id, $respuesta_id)
    {

        if (!isset($publicacion_id) && !isset($respuesta_id)) {
            return back()->with("status.updateRespuesta", "error");
        }

        if (!$request->has('publicaciontxt') || !isset($request->publicaciontxt)) {
            return back()->with("status.updateRespuesta", "error");
        }

        $publicacion = Publicacion::where('id', $publicacion_id)->first();


        //SABER SI EXISTE UN ARCHIVO
        // $statusFile = false;
        // $miFile     = "";
        // for ($a=0; $a <= count($request->upload) - 1; $a++) {
        //     $exists = Storage::exists('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/'.$request->file('upload')[$a]->getClientOriginalName());
        //     if ($exists) {
        //         $statusFile = true;
        //         $miFile     = $request->file('upload')[$a]->getClientOriginalName();
        //         return false;
        //     }
        // }

        // if ($statusFile) {
        //     return back()->withInput()->with("status.fileExist", $miFile);
        // }


        DB::beginTransaction();
        if ($publicacion) {
            $respuesta = Respuesta::where('id', $respuesta_id)
                            ->where('publicacion_id', $publicacion_id)
                            ->where('user_id', auth()->user()->id)->first();

            if ($respuesta) {
                $respuesta->respuesta = $request->publicaciontxt;
                if ($respuesta->save()) {
                    if ( $request->hasFile('upload') ) {
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
                        for ($j=0; $j <= count($request->upload) - 1; $j++) { 

                            $exists = Storage::exists('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/'.$request->file('upload')[$j]->getClientOriginalName());
                            if ($exists) {
                                $statusFile = true;
                                $miFile    .= $request->file('upload')[$j]->getClientOriginalName().", ";
                            }
                            else {

                                $rootFile = $request->file('upload')[$j]
                                                ->storeAs('public/aulas/'.$publicacion->curso_id.'/'.$publicacion_id.'/respuestas/'.$respuesta_id.'/', $request->file('upload')[$j]->getClientOriginalName());
                                $archivos[] = $rootFile;
                            }
                        }


                        $arrayArchivos        = json_encode($archivos);
                        $respuesta->archivos  = $arrayArchivos;
                        if ($respuesta->save()) {

                            if ($statusFile) {
                                DB::commit();
                                return back()->withInput()->with("status.fileExist", $miFile);
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


    protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }


    protected function eliminarCarpeta($file)
    {
        return \Storage::deleteDirectory($file);
    }
}
