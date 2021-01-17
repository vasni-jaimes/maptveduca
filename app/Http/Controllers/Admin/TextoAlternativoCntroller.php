<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recomendacion;
use App\Career;
use App\Course;
use DB;

class TextoAlternativoCntroller extends Controller
{
    public function __construct()
    {
        $this->middleware("authadmin:auth");
    }


    public function show()
    {
    	$carreras = Career::all();
        return view("admin.lista-carreras", compact("carreras"));
    }


   	public function index()
   	{
   		$materias = null;
   		return view('admin.lista-cursos-recomendados', compact("materias"));
   	}



}
