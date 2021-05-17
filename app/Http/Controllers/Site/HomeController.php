<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Clase;
use App\Evento;
use App\ClaseSesion;
use Carbon\Carbon;

class HomeController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        //FECHA ACTUAL
        $carbon         = new Carbon();
        $fechaActual    = $carbon->now();
        $hoy            = $fechaActual->format('Y-m-d H:s:i');
        //FECHA ACTUAL\

    	$cursos         = Course::where("status", 1)->orderBy('id', 'DESC')->get();
        $eventos        = Evento::where("status", 1)->where('fecha_lanzamiento', '>', $hoy)->orderBy('id', 'DESC')->get();

        //OBTENER CLASES FUTURAS
        $sesiones       = ClaseSesion::where("fecha_inicio", "<", $hoy)->get();
        $arraySesines   = collect($sesiones)->pluck('clas_id')->toArray();
        $clases         = Clase::with(["sesiones", "instructor"])
                                    ->whereNotIn("id", $arraySesines)->where("status", 1)->orderBy('id', 'DESC')->get();
        //\OBTENER CLASES FUTURAS
        
    	return view("site.home", compact("cursos", "clases", "eventos"));
    }
}
