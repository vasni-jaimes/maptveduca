<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Favorito;

class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	/* FAVORITOS */
    	$favoritosCursos = Favorito::with(['cursos'])
    							->where('user_id', auth()->user()->id)
    							->where('curso_id', '!=', null)->get();
    	$favoritosEventos = Favorito::with(['eventos'])
    							->where('user_id', auth()->user()->id)
    							->where('evento_id', '!=', null)->get();
    	$favoritosClases = Favorito::with(['clases'])
    							->where('user_id', auth()->user()->id)
    							->where('clase_id', '!=', null)->get();

    	return view('site.micuenta', compact("favoritosCursos", "favoritosEventos", "favoritosClases"));
    }
}
