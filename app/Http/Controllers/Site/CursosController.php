<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Instructor;
use App\Course;
use App\Category;

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

    public function show($curso_id)
    {
    	$curso = Course::with(["instructor"])->where("status", 1)->where("slug", $curso_id)->first();
        $temario = json_decode($curso->temario);
        //return response()->json($temario);
    	return view("site.single-cursos", compact("curso", "temario"));
    }
}
