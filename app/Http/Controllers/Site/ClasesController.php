<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Clase;
use App\ClaseSesion;

class ClasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkClase', ['only' => ['show']]);
    }


    public function index()
    {
    	//FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy          = date('Y-m-d H:i:s', time());

        //OBTENER CLASES FUTURAS
        $sesiones 		= ClaseSesion::where("fecha_inicio", "<", $hoy)->get();
        $arraySesines 	= collect($sesiones)->pluck('clas_id')->toArray();
        $clases 		= Clase::with(["sesiones", "instructor"])->whereNotIn("id", $arraySesines)->where("status", 1)->get();
        //\OBTENER CLASES FUTURAS

    	return view('site.clases-linea', compact("clases"));
    }


    public function show($clase_id)
    {
    	$clase = Clase::with(["sesiones", "instructor"])
    				->where("slug", $clase_id)
    				->where("status", 1)->first();

    	return view('site.clases-sessiones', compact("clase"));
    }
}
