<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Instructor;
use App\Course;
use App\Category;
use App\Favorito;

class CursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categorias     = Category::with(["subcategorias"])->where("status", 1)->get();
        $instructores   = Instructor::with("Cursos")->where("status", 1)->get();
        
    	return view("site.cursos", compact("categorias", "instructores"));
    }

    public function show($curso_id, $clase_id = null)
    {
        if (auth()->user()->tieneSuscripcion() == false && $clase_id != null) {
            return redirect()->route('single-cursos.show', $curso_id);
        }
    
        if ($clase_id == null) {
            $curso = Course::with(["instructor"])->where("status", 1)->where("slug", $curso_id)->first();
            $temario = json_decode($curso->temario);
            $clase = array("slug" => $curso->slug, "url_video" => [$curso->video_bienvenida], 
                                "nombre_video" => "Bienvenida", "material_extra" => [], "descripcion" => $curso->descripcion_bienvenida);
        }
    	else {
            $curso = Course::with(["instructor"])->where("status", 1)->where("slug", $curso_id)->first();
            $temario = json_decode($curso->temario);
            $clase = $this->obtenerClase($clase_id, $temario);

            if (!$clase) {
                return redirect()->route('single-cursos.show', $curso_id);
            }
        }

        $favorito = Favorito::where('user_id', auth()->user()->id)->where('curso_id', $curso->id)->first();

    	return view("site.single-cursos", compact("curso", "temario", "clase", "clase_id", "favorito"));
    }

    public function download($slug_curso, $slug_sesion)
    {
        if ( isset($slug_curso) && isset($slug_sesion) ) {
            $curso   = Course::where('slug', $slug_curso)->first();
            $temario = json_decode($curso->temario);
            $clase   = $this->obtenerClase($slug_sesion, $temario);

            $zip = new \ZipArchive();
            $zip->open(public_path().'font_files.zip', \ZipArchive::CREATE);
            $zip->addFile(public_path()."robots.txt",'robots.txt');

            echo "s";
              
            // $zip->addFile('fonts/Monoton/Monoton-Regular.ttf', 'Monoton-Regular.ttf');
            // $zip->addFile('fonts/Monoton/OFL.txt', 'license.txt');
              
            $zip->close();

            // if (!empty($clase['material_extra'])) {
            //     for ($i=0; $i <= count($clase['material_extra']) - 1; $i++) {
            //         return response()->download(storage_path("app/".$clase['material_extra'][$i]));
            //     }
            // }
        }
    }


    protected function obtenerClase($clase_id, $temario)
    {
        $clase = false;
        foreach ($temario as $team) {
            if ($team->slug == $clase_id) {
                $clase = array("slug" => $team->slug, "url_video" => $team->url_video, 
                                "nombre_video" => $team->nombre_video, "material_extra" => $team->material_extra, 
                                "descripcion" => $team->descripcion_curso);
            }
        }

        return $clase;
    }

}
