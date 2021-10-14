<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Instructor;
use App\Course;
use App\Category;
use App\Favorito;
use App\Recomendacion;
use App\TableroCursos;
use DB;

class CursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkMembresiaCurso', ["only" => ["show", "download"]]);
    }


    public function index($origen = null)
    {
        //if ($origen == null) {
            $cursos         = Course::where("status", 1)->get();
            $categorias     = Category::with(["subcategorias"])->where("status", 1)->get();
            $instructores   = Instructor::with("Cursos")->where("status", 1)->get();
        //}
        
    	return view("site.cursos", compact("categorias", "instructores", "cursos"));
    }

    public function show($curso_id, $clase_id = null, $subclase_id = 0)
    {
        if ($clase_id == null) {
            $curso   = Course::with(["instructor"])->where("status", 1)->where("slug", $curso_id)->first();
            $temario = json_decode($curso->temario);
            $clase   = array("slug" => $curso->slug, "url_video" => $curso->video_bienvenida, 
                                "nombre_video" => "Bienvenida", "material_extra" => [], "descripcion" => $curso->descripcion_bienvenida);
        }
    	else {
            $curso   = Course::with(["instructor"])->where("status", 1)->where("slug", $curso_id)->first();
            $temario = json_decode($curso->temario);
            $clase   = $this->obtenerClase($clase_id, $temario, $subclase_id);
            //agregar el curso a mi tablero
            $this->agregaramitablero($curso->id);

            if (!$clase) {
                return redirect()->route('single-cursos.show', $curso_id);
            }
        }

        $validarSide = $this->validacionSidebar($curso->id);
        $miTablero   = $this->estaEnMiTablero($curso->id);
        $favorito    = Favorito::where('user_id', auth()->user()->id)->where('curso_id', $curso->id)->first();
    	return view("site.single-cursos", compact("curso", "temario", "clase", "clase_id", "favorito", "validarSide", "miTablero", "subclase_id"));
    }

    public function download($slug_curso, $slug_sesion)
    {
        if ( isset($slug_curso) && isset($slug_sesion) ) {
            $curso   = Course::where('slug', $slug_curso)->first();
            $temario = json_decode($curso->temario);
            $clase   = $this->obtenerClase($slug_sesion, $temario);

            if (!empty($clase['material_extra'])) {
                for ($i=0; $i <= count($clase['material_extra']) - 1; $i++) {
                    return response()->download(storage_path("app/".$clase['material_extra'][$i]));
                }
            }
        }
    }


    public function agregarTablero(Request $request)
    {
        if (!auth()->user()->tieneSuscripcion()) {
            return response()->json(["message" => "not_membresia"]);
        }

        if ( $request->has('slug') && $request->has('slug')) {
            $curso = Course::where('slug', $request->slug)->where('status', 1)->first();
            if ($curso) {

                $cursoTablero = DB::table('tablero_cursos')
                                    ->where('curso_id', $curso->id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();

                if (!$cursoTablero) {
                    $tablero = DB::table('tablero_cursos')->insert([
                                "user_id" => auth()->user()->id,
                                "curso_id" => $curso->id,
                                "progreso" => 0
                            ]);

                    if ($tablero) {
                        return response()->json(["message" => "ok"]);
                    }

                    return response()->json(["message" => "error_save"]);
                }

                return response()->json(["message" => "ok"]);
            }

            return response()->json(["message" => "not_curso"]);
        }

        return response()->json(["message" => "not_parameter"]);
    }


    protected function obtenerClase($clase_id, $temario, $subclase = 0)
    {
        $clase = false;
        foreach ($temario as $team) {
            if ($team->slug == $clase_id) {
                $clase = array("slug" => $team->slug, "url_video" => $team->url_video[$subclase], 
                                "nombre_video_url" => $team->nombre_video_url[$subclase], "nombre_video" => $team->nombre_video, 
                                "material_extra" => $team->material_extra, "descripcion" => $team->descripcion_curso);
            }
        }

        return $clase;
    }


    protected function validacionSidebar($curso_id)
    {
        if ( auth()->user()->tieneSuscripcion() && auth()->user()->ultimaSuscripcion()->id == 1 ) {
            return "sb#2";
        }
        if ( auth()->user()->tieneSuscripcion() && auth()->user()->ultimaSuscripcion()->id == 2 ) {
            //validar si este curso esta destro de la carrera
            $cursoCarrera = $this->validarPorTrimestre($curso_id);
            if (!$cursoCarrera) {
               return "sb#2";
            }
            else {
                return "sb#4";
            }
        }
        if ( auth()->user()->tieneSuscripcion() && auth()->user()->ultimaSuscripcion()->id == 2 ) {
            return "sb#3";
        }

        return false;
    }

    protected function validarPorTrimestre($curso_id)
    {
        $pagos = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->get();

        if (count($pagos) <= 3) {
           return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 1)
                                    ->count();
        }
        else if (count($pagos) > 3 && count($pagos) <= 6) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 2)
                                    ->count();
        }
        else if (count($pagos) > 6 && count($pagos) <= 9) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 3)
                                    ->count();
        }
        else if (count($pagos) > 9 && count($pagos) <= 12) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 4)
                                    ->count();
        }
        else if (count($pagos) > 12 && count($pagos) <= 15) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 5)
                                    ->count();
        }
        else if (count($pagos) > 15 && count($pagos) <= 18) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 6)
                                    ->count();
        }
        else if (count($pagos) > 18 && count($pagos) <= 21) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 7)
                                    ->count();
        }
        else if (count($pagos) > 21 && count($pagos) <= 24) {
            return Recomendacion::where('carrera_id', auth()->user()->obtenerCarrera())
                                    ->where('curso_id', $curso_id)
                                    ->where('trimestre', 8)
                                    ->count();
        }
    }


    protected function agregaramitablero($curso_id)
    {
        $tablero = TableroCursos::where('curso_id', $curso_id)
                        ->where('user_id', auth()->user()->id)->first();

        if (!$tablero) {
            $tablero = new TableroCursos();
            $tablero->curso_id = $curso_id;
            $tablero->user_id = auth()->user()->id;
            $tablero->progreso = 0;
            if ($tablero->save()) {
                return true;
            }
        }

        return true;
    }

    protected function estaEnMiTablero($curso_id)
    {
        if (!auth()->user()->tieneSuscripcion()) {
            return false;
        }

        $cursoTablero = DB::table('tablero_cursos')
                                    ->where('curso_id', $curso_id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();

        if ($cursoTablero) {
            return true;
        }

        return false;
    }

}
