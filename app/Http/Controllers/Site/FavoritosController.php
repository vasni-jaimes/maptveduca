<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favorito;
use App\Course;
use DB;

class FavoritosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
    	if ( $request->has('curso')) {
    		DB::beginTransaction();

    		$curso = Course::where('slug', $request->curso)->where('status', 1)->first();

    		if (!$curso) {
    			return response()->json(['message' => 'error_course']);
    		}

    		$getFavorito = Favorito::where('user_id', auth()->user()->id)
    								->where('curso_id', $curso->id)->first();

    		if (!$getFavorito) {

    			$favorito 			 = new Favorito();
    			$favorito->user_id 	 = auth()->user()->id;
    			$favorito->curso_id	 = $curso->id;

	    		if ($favorito->save()) {
	    			DB::commit();
	    			return response()->json(['message' => 'ok']);
	    		}
    		}

    		DB::rollback();
    		return response()->json(['message' => 'error']);
    	}

    	return response()->json(['message' => 'error_parameters']);
    }
}
