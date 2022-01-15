<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Recomendacion;
use App\Career;
use App\Course;
use App\TextoAlternativo;
use DB;

class TextoAlternativoCntroller extends Controller
{
    protected $helper;

    public function __construct(Helper $helper)
    {
        $this->middleware("authadmin:auth");
        $this->middleware(["role:admin,admins"]);
        $this->helper = $helper;
    }


    public function show()
    {
    	$carreras = Career::all();
        return view("admin.lista-carreras", compact("carreras"));
    }


   	public function index($carrera_id)
   	{
   		$materiasCarreras = DB::table('courses_careers')
                                ->where('career_id', $carrera_id)
                                ->select('course_id')
                                ->get()->pluck('course_id')->toArray();

        $materias         = Recomendacion::with('cursos')
                                ->whereIn('curso_id', $materiasCarreras)
                                ->groupBy('curso_id')
                                ->get();

        $helper           = $this->helper;

   		return view('admin.lista-cursos-recomendados', compact("materias", "helper", "carrera_id"));
   	}


    public function getTexto($curso_id, $carrera_id)
    {
        $curso      = Course::where('slug', $curso_id)->first();
        $textoalt   = TextoAlternativo::where('curso_id', $curso->id)->first();
        if (!$textoalt) {
            $textoalt = false;
        }

        return view('admin.agregar-textoalternativo', compact('textoalt', 'curso', 'carrera_id'));
    }


    public function insertTexto(Request $request, $curso_id)
    {
        if (!$request->has('textoalternativo') || !isset($request->textoalternativo)) {
            return back()->with("status.newTexto", "error");
        }

        if (!is_numeric($curso_id) || !isset($curso_id)) {
            return back()->with("status.newTexto", "error");
        }

        DB::beginTransaction();

        $txtAlterno = TextoAlternativo::where('curso_id', $curso_id)->first();

        if ($txtAlterno) {
            $txtAlterno->texto = str_replace(PHP_EOL, '<br />', $request->textoalternativo);

            if ($txtAlterno->save()) {
                DB::commit();
                return back()->with("status.newTexto", "success");
            }

             DB::rollback();
            return back()->with("status.newTexto", "error");
        }
        else {
            $textoAltern = new TextoAlternativo();
            $textoAltern->curso_id = $curso_id;
            $textoAltern->texto    = str_replace(PHP_EOL, '<br />', $request->textoalternativo);

            if ($textoAltern->save()) {
                DB::commit();
                return back()->with("status.newTexto", "success");
            }

             DB::rollback();
            return back()->with("status.newTexto", "error");
        }

        DB::rollback();
        return back()->with("status.newTexto", "error");
    }



}
