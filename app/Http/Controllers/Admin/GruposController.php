<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarAgregarGrupo;
use App\Http\Requests\ValidarUpdateGrupos;
use App\Grupo;
use App\CiclosEscolares;
use DB;

//HELPERS
use App\Helpers\Helper;

class GruposController extends Controller
{

    public function __construct(Helper $helper)
    {
        $this->middleware("authadmin:auth");
        $this->middleware(["role:admin,admins"]);
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::all();
        $helper = $this->helper;
        return view('admin.listado-grupos', compact('grupos', 'helper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciclos = CiclosEscolares::all();
        return view('admin.agregar-grupo', compact('ciclos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarAgregarGrupo $request)
    {
        DB::beginTransaction();
        $grupo           = new Grupo();
        $grupo->nombre   = $request->nombre_grupo;
        $grupo->ciclo_id = $request->ciclo_escolar;

        if ($grupo->save()) {
            
            $grupo->slug = $this->helper->createSlug($request->nombre_grupo, $grupo->id, "maptv");
            if ($grupo->save()) {
                DB::commit();
                return back()->with("status.newGrupo", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.newGrupo", "error");
        }

        DB::rollback();
        return back()->withInput()->with("status.newGrupo", "error");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $grupo = Grupo::where('slug', $slug)->first();
        $ciclos = CiclosEscolares::all();
        return view('admin.editar-grupo', compact('grupo', 'ciclos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarUpdateGrupos $request, $slug)
    {
        DB::beginTransaction();
        $grupo           = Grupo::where('slug', $slug)->first();
        $grupo->nombre   = $request->nombre_grupo;
        $grupo->slug     = $this->helper->createSlug($request->nombre_grupo, $grupo->id, "maptv");
        $grupo->ciclo_id = $request->ciclo_escolar;
        
        if ($grupo->save()) {
            DB::commit();
            return back()->with("status.updateGrupo", "success");
        }
        DB::rollback();
        return back()->withInput()->with("status.updateGrupo", "error");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        DB::beginTransaction();
        $grupo = Grupo::where('slug', $slug)->first();
        if ($grupo->delete()) {
            DB::commit();
            return redirect()->route('index-admin.grupos')->with("status.deleteeGrupo", "success");
        }

        DB::rollback();
        return redirect()->route('index-admin.grupos')->with("status.deleteeGrupo", "error");
    }
}
