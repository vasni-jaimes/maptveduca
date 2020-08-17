<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class HomeController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$cursos = Course::where("status", 1)->select("url_img")->get();
    	//return response()->json($cursos);
    	return view("site.home", compact("cursos"));
    }
}
