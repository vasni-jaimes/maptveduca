<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarFechasCicloEscolar;
use App\Grupo;
use App\StatusInscripcion;
use App\CiclosEscolares;
use App\CiclosFechas;
use App\Helpers\Helper;
use DB;

class InscripcionesController extends Controller
{
	public function __construct(Helper $helper)
	{
		$this->middleware("authadmin:auth");
        $this->middleware(["role:admin,admins"]);
		$this->helper = $helper;
	}

	public function listadoCiclos()
	{
		$ciclos = CiclosEscolares::with(['fechasTrimestres'])->get();
		$helper = $this->helper;
		return view('admin.inscripciones_fechas.listado-ciclos-escolares', compact('ciclos', 'helper'));
	}

	public function fechas()
	{
		return view('admin.inscripciones_fechas.agregar-fechas-trimestre');
	}

	public function editarFechas($slug)
	{
		$ciclo = CiclosEscolares::with(['fechasTrimestres'])->where('slug', $slug)->first();
		$titulo = ['Cero', 'Primer', 'Segundo', 'Tercer', 'Cuarto', 'Quinto', 'Sexto', 'Septimo', 'Octavo'];
		
		return view('admin.inscripciones_fechas.editar-fechas-trimestre', compact('ciclo', 'titulo', 'slug'));
	}


	public function actualizarFechas(ValidarFechasCicloEscolar $request, $slug)
	{
		DB::beginTransaction();
		$ciclo = CiclosEscolares::where('slug', $slug)->first();
		$ciclo->nombre = $request->nombre_ciclo;

		if ($ciclo->save()) {
			$ciclo->slug = $this->helper->createSlug($request->nombre_ciclo, $ciclo->id, "maptv");

			if (CiclosFechas::where('ciclo_id', $ciclo->id)->delete()) {

				for ($i=1; $i <= 8; $i++) { 
					$fecha = new CiclosFechas();
					$fecha->ciclo_id   = $ciclo->id;
					$fecha->trimestre  = $i;
					$fecha->fecha_inicio = request("fecha_inicio-".$i);
					$fecha->fecha_final = request("fecha_final-".$i);
					$fecha->save();
				}

				if ($ciclo->save()) {
					DB::commit();
	            	return redirect()->route('vista-editar_ciclo.fechas', $slug)->with("status.editar_ciclos", "success");
				}

				DB::rollback();
            	return back()->with("status.editar_ciclos", "error");
			}	

			DB::rollback();
            return back()->with("status.editar_ciclos", "error");
		}

		DB::rollback();
        return back()->with("status.editar_ciclos", "error");
	}


	public function guardarCiclo(ValidarFechasCicloEscolar $request)
	{
		DB::beginTransaction();
		$ciclos = new CiclosEscolares();
		$ciclos->nombre = $request->nombre_ciclo;

		if ($ciclos->save()) {
			$ciclos->slug = $this->helper->createSlug($request->nombre_ciclo, $ciclos->id, "maptv");

			for ($i=1; $i <= 8; $i++) { 
				$fecha = new CiclosFechas();
				$fecha->ciclo_id   = $ciclos->id;
				$fecha->trimestre  = $i;
				$fecha->fecha_inicio = request("fecha_inicio-".$i);
				$fecha->fecha_final = request("fecha_final-".$i);
				$fecha->save();
			}

			if ($ciclos->save()) {
				DB::commit();
            	return redirect()->route('vista-crear_ciclo.fechas')->with("status.crear_ciclos", "success");
			}

			DB::rollback();
            return back()->with("status.crear_ciclos", "error");
		}

		DB::rollback();
        return back()->with("status.crear_ciclos", "error");
	}

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


    public function eliminarFechas($slug)
    {
    	if ($slug == null) {
    		return back()->with("status.lista_ciclos", "error");
    	}

    	DB::beginTransaction();
		$ciclo 	= CiclosEscolares::where('slug', $slug)->first();

		if (CiclosFechas::where("ciclo_id", $ciclo->id)->delete()) {

			if ($ciclo->delete()) {
				DB::commit();
				return back()->with("status.lista_ciclos", "success");
			}

			DB::rollback();
			return back()->with("status.lista_ciclos", "error");
		}
		
		DB::rollback();
		return back()->with("status.lista_ciclos", "error");
    }
}
