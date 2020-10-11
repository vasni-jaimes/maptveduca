<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Clase;
use App\Evento;
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

    	$cursos         = Course::where("status", 1)->get();
        $clases         = Clase::where("status", 1)->get();
        $eventos        = Evento::where("status", 1)->where('fecha_lanzamiento', '>', $hoy)->get();
        
    	return view("site.home", compact("cursos", "clases", "eventos"));
    }
}
