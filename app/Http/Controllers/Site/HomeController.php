<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Clase;
use App\Evento;

class HomeController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$cursos = Course::where("status", 1)->get();
        $clases = Clase::where("status", 1)->get();
        $eventos = Evento::where("status", 1)->get();
    	//return response()->json($cursos);
    	return view("site.home", compact("cursos", "clases", "eventos"));
    }
}
