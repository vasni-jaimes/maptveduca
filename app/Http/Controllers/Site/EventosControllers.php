<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Evento;
use App\Favorito;
use DB;

class EventosControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ValidarEventosExist', ["only" => ["show"]]);
    }

    public function index()
    {
    	//FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy          = date('Y-m-d H:i:s', time());

    	$eventos = Evento::with(["instructor"])->where("status", 1)->where("fecha_lanzamiento", ">", $hoy)->get();
    	$archivados = Evento::with(["instructor"])->where("status", 1)->where("fecha_lanzamiento", "<", $hoy)->get();

        //return $eventos;

    	return view("site.eventos", compact("eventos", "archivados"));
    }

    public function show($slug)
    {
    	$evento          = Evento::with(["instructor"])->where("slug", $slug)->first();
        $favorito        = Favorito::where('user_id', auth()->user()->id)->where('evento_id', $evento->id)->first();
        $eventoPagado    = DB::table('eventos_pagados')->where("user_id", auth()->user()->id)->where('evento_id', $evento->id)->first();
        $estaEnMiTablero = $this->estaEnMiTablero($evento->id);

    	return view('site.single-eventos', compact("evento", "favorito", "eventoPagado", "estaEnMiTablero"));    
    }


    public function agregarTablero(Request $request)
    {
        if (!auth()->user()->tieneSuscripcion()) {
            return response()->json(["message" => "not_membresia"]);
        }

        if ( $request->has('slug') && $request->has('slug')) {
            $evento = Evento::where('slug', $request->slug)->where('status', 1)->first();
            if ($evento) {

                $cursoTablero = DB::table('tablero_eventos')
                                    ->where('evento_id', $evento->id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();

                if (!$cursoTablero) {
                    $tablero = DB::table('tablero_eventos')->insert([
                                "user_id" => auth()->user()->id,
                                "evento_id" => $evento->id,
                                "progreso" => 0
                            ]);

                    if ($tablero) {
                        return response()->json(["message" => "ok"]);
                    }

                    return response()->json(["message" => "error_save"]);
                }

                return response()->json(["message" => "ok"]);
            }

            return response()->json(["message" => "not_curso"]);
        }

        return response()->json(["message" => "not_parameter"]);
    }


    protected function estaEnMiTablero($evento_id)
    {
        if (!auth()->user()->tieneSuscripcion()) {
            return false;
        }

        $eventoTablero = DB::table('tablero_eventos')
                                    ->where('evento_id', $evento_id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();

        if ($eventoTablero) {
            return true;
        }

        return false;
    }
}
