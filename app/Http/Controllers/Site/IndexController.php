<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instructor;
use App\AdministracionFecha;
use App\Membresia;

class IndexController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest');
    }
	
    public function showIndex()
    {
    	$instructores       = Instructor::where("status", 1)->get();
        $adminFecha         = AdministracionFecha::first();
        $membresiaAcademica = Membresia::where("slug", 'membresia-academica')->first();
        $membresiaBasica    = Membresia::where("slug", 'membresia-basica')->first();

    	return view("site.index", compact("instructores", "adminFecha", "membresiaAcademica", "membresiaBasica"));
    }
}
