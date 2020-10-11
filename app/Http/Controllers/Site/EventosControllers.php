<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;

class EventosControllers extends Controller
{
    

    public function index()
    {
    	//FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy          = date('Y-m-d H:i:s', time());

    	$eventos = Evento::with(["instructor"])->where("status", 1)->where("fecha_lanzamiento", ">", $hoy)->get();
    	$archivados = Evento::with(["instructor"])->where("status", 1)->where("fecha_lanzamiento", "<", $hoy)->get();
    	return view("site.eventos", compact("eventos", "archivados"));
    }

    public function show($slug)
    {
    	$evento = Evento::with(["instructor"])->where("slug", $slug)->first();
    	return view('site.single-eventos', compact("evento"));    
    }
}
