<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ValidarFechaContenido;
use DB;
use App\AdministracionFecha;

class AdminMembresiaController extends Controller
{
	public function __construct()
    {
        $this->middleware("authadmin:auth");
    }
    
    public function create()
    {
    	//return "ddd";
    	$administracion_fechas = DB::table('administracion_fechas')->first();
    	return view('admin.agregar-administracion-fecha-inscripcion', compact("administracion_fechas"));
    }


    public function edit(ValidarFechaContenido $request)
    {
    	//return $request;

    	if ($request->has('inicio_trimestre')) {
	    	DB::beginTransaction();
	    	$administracion_fechas 					 = AdministracionFecha::first();

	    	if ($administracion_fechas) {
	    		$administracion_fechas->inicio_trimestre = $request->inicio_trimestre;
	    	}
	    	else {
	    		$administracion_fechas 					= new AdministracionFecha();
	    		$administracion_fechas->inicio_trimestre = $request->inicio_trimestre;
	    	}
	    	

	    	if ($administracion_fechas->save()) {
	    		DB::commit();
	    		return back()->with("status.newFechaInscripcion", "success");
	    	}

	    	DB::rollback();
	    	return back()->with("status.newFechaInscripcion", "error");
	    }

	    DB::rollback();
	    return back()->with("status.newFechaInscripcion", "error");
    }
}
