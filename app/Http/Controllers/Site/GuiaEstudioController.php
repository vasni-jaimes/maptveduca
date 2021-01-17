<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RecomendacionesExtra;
use App\Recomendacion;
use Illuminate\Support\Facades\Storage;

class GuiaEstudioController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$recomendaciones = Recomendacion::with(['cursos' => function($query){
	                            $query->where('status', 1);
	                        }])
	                        ->where('carrera_id', auth()->user()->obtenerCarrera())
	                        ->get();

        $recomendacionesextra = RecomendacionesExtra::with(['cursos' => function($query){
                                    $query->where('status', 1);
                                }])
                                ->where('carrera_id', auth()->user()->obtenerCarrera())
                                ->get();

    	return view('site.guia-estudio', compact("recomendaciones", "recomendacionesextra"));
    }
}
