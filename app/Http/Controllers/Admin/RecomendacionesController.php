<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recomendacion;
use App\Career;
use App\Course;
use DB;

class RecomendacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware("authadmin:auth");
        $this->middleware("ValidarAdmin");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Career::all();
        return view("admin.lista-recomendaciones", compact("carreras"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $cursos     = Course::where('status', 1)->get();
        $carrera    = Career::where('id', $id)->first();
        $trimestre1 = Recomendacion::where('carrera_id', $id)->where('trimestre', 1)->get();
        $trimestre2 = Recomendacion::where('carrera_id', $id)->where('trimestre', 2)->Get();
        $trimestre3 = Recomendacion::where('carrera_id', $id)->where('trimestre', 3)->get();
        $trimestre4 = Recomendacion::where('carrera_id', $id)->where('trimestre', 4)->get();
        $trimestre5 = Recomendacion::where('carrera_id', $id)->where('trimestre', 5)->get();
        $trimestre6 = Recomendacion::where('carrera_id', $id)->where('trimestre', 6)->get();
        $trimestre7 = Recomendacion::where('carrera_id', $id)->where('trimestre', 7)->get();
        $trimestre8 = Recomendacion::where('carrera_id', $id)->where('trimestre', 8)->get();

        $tri1 = collect($trimestre1)->pluck('curso_id')->toArray();
        $tri2 = collect($trimestre2)->pluck('curso_id')->toArray();
        $tri3 = collect($trimestre3)->pluck('curso_id')->toArray();
        $tri4 = collect($trimestre4)->pluck('curso_id')->toArray();
        $tri5 = collect($trimestre5)->pluck('curso_id')->toArray();
        $tri6 = collect($trimestre6)->pluck('curso_id')->toArray();
        $tri7 = collect($trimestre7)->pluck('curso_id')->toArray();
        $tri8 = collect($trimestre8)->pluck('curso_id')->toArray();

        //return $tri1;

        return view("admin.agregar-recomendaciones", compact("cursos", "carrera", "tri1", "tri2", "tri3", "tri4", "tri5", "tri6", "tri7", "tri8"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //BORRAR LAS RECOMENDACIONES ANTERIORES
        Recomendacion::where('carrera_id', $id)->delete();

        try {
            //return $request;
            DB::beginTransaction();

            //PRIMER TRIMESTRE
            if ( $request->has('select_cursos_primer') ) {
                $primerTrimestre = $request->select_cursos_primer;
                for ($i=0; $i <= count($primerTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 1;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $primerTrimestre[$i];
                    $recomendacion->save();
                }
            }

            //SEGUNDO TRIMESTRE
            if ( $request->has('select_cursos_segundo') ) {
                $segundoTrimestre = $request->select_cursos_segundo;
                for ($i=0; $i <= count($segundoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 2;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $segundoTrimestre[$i];
                    $recomendacion->save();
                }
            }


            //TERCER TRIMESTRE
            if ( $request->has('select_cursos_tercer') ) {
                $tercerTrimestre = $request->select_cursos_tercer;
                for ($i=0; $i <= count($tercerTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 3;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $tercerTrimestre[$i];
                    $recomendacion->save();
                }
            }


            //CUARTO TRIMESTRE
            if ( $request->has('select_cursos_cuarto') ) {
                $cuartoTrimestre = $request->select_cursos_cuarto;
                for ($i=0; $i <= count($cuartoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 4;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $cuartoTrimestre[$i];
                    $recomendacion->save();
                }
            }


            //QUINTO TRIMESTRE
            if ( $request->has('select_cursos_quinto') ) {
                $quintoTrimestre = $request->select_cursos_quinto;
                for ($i=0; $i <= count($quintoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 5;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $quintoTrimestre[$i];
                    $recomendacion->save();
                }
            }


            //SEXTO TRIMESTRE
            if ( $request->has('select_cursos_sexto') ) {
                $sextoTrimestre = $request->select_cursos_sexto;
                for ($i=0; $i <= count($sextoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 6;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $sextoTrimestre[$i];
                    $recomendacion->save();
                }
            }


            //SEPTIMO TRIMESTRE
            if ( $request->has('select_cursos_septimo') ) {
                $septimoTrimestre = $request->select_cursos_septimo;
                for ($i=0; $i <= count($septimoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 7;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $septimoTrimestre[$i];
                    $recomendacion->save();
                }
            }


             //OCTAVO TRIMESTRE
            if ( $request->has('select_cursos_octavo') ) {
                $octavoTrimestre = $request->select_cursos_octavo;
                for ($i=0; $i <= count($octavoTrimestre) - 1; $i++) { 
                    $recomendacion = new Recomendacion();
                    $recomendacion->trimestre   = 8;
                    $recomendacion->carrera_id  = $id;
                    $recomendacion->curso_id    = $octavoTrimestre[$i];
                    $recomendacion->save();
                }
            }


            DB::commit();
            return back()->with("status.recomendacion", "success");

        } catch(\Exception $e) {
            DB::rollback();
            return back()->withInput()->with("status.recomendacion", "error");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
