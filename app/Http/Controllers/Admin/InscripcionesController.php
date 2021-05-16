<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Grupo;
use App\StatusInscripcion;
use DB;

class InscripcionesController extends Controller
{
    public function index()
    {
    	$grupos        = Grupo::all();
    	$status        = StatusInscripcion::first();
    	$gruposStatus  = DB::table('grupos_inscripciones')->get();
        $mygrupos      = collect($gruposStatus)->pluck('grupo_id')->toArray();

    	return view('admin.status-inscripciones', compact('grupos', 'status', 'gruposStatus', 'mygrupos'));
    }

    public function store(Request $request)
    {
    	$status = StatusInscripcion::first();

    	DB::beginTransaction();
    	if ($status) {
    		$status->status = $request->status;
    		if ($status->status == 3) {
    			$status->fecha_inicio 	= $request->fecha_inicio;
    			$status->fecha_fin 		= $request->fecha_fin;
    		}

    		if ($status->save()) {

    			DB::table('grupos_inscripciones')->truncate();
    			for ($i=0; $i <= count($request->select_grupos) - 1; $i++) { 
    				DB::table('grupos_inscripciones')->insert(
	    				[
	    					"grupo_id" => $request->select_grupos[$i],
	    					"status_inscripcion_id" => $status->id,
	    				]
	    			);
    			}

    			DB::commit();
            	return redirect()->route('inscripciones.index')->with("status.inscripciones", "success");
    		}

    		DB::rollback();
            return back()->with("status.inscripciones", "error");
    	}
    	else {
    		$status = new StatusInscripcion();
    		$status->status = $request->status;
    		if ($status->status == 3) {
    			$status->fecha_inicio 	= $request->fecha_inicio;
    			$status->fecha_fin 		= $request->fecha_fin;
    		}

    		if ($status->save()) {

    			for ($i=0; $i <= count($request->select_grupos) - 1; $i++) { 
    				DB::table('grupos_inscripciones')->insert(
	    				[
	    					"grupo_id" => $request->select_grupos[$i],
	    					"status_inscripcion_id" => $status->id,
	    				]
	    			);
    			}

    			DB::commit();
            	return redirect()->route('inscripciones.index')->with("status.inscripciones", "success");
    		}

    		DB::rollback();
            return back()->with("status.inscripciones", "error");
    	}
    }
}
