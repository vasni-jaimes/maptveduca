<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Favorito;
use App\Course;
use App\Evento;
use DB;

class FavoritosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
    	if ( $request->has('curso') && $request->has('seccion')) {

            if ($request->seccion == "evento") {
                DB::beginTransaction();

                $evento = Evento::where('slug', $request->curso)->where('status', 1)->first();
                if (!$evento) {
                    return response()->json(['message' => 'error_event']);
                }

                $getFavorito = Favorito::where('user_id', auth()->user()->id)
                                    ->where('evento_id', $evento->id)->first();

                if (!$getFavorito) {
                    $favorito            = new Favorito();
                    $favorito->user_id   = auth()->user()->id;
                    $favorito->evento_id  = $evento->id;

                    if ($favorito->save()) {
                        DB::commit();
                        return response()->json(['message' => 'ok']);
                    }
                }

                DB::rollback();
                return response()->json(['message' => 'error']);

            }
            else if ($request->seccion == "curso") {
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

            return response()->json(['message' => 'error_seccion']);
    	}

    	return response()->json(['message' => 'error_parameters']);
    }


    public function delete(Request $request)
    {
        if ( $request->has('slug') && $request->has('seccion')) {

            if ($request->seccion == "curso") {
                DB::beginTransaction();

                $curso = Course::where('slug', $request->slug)->where('status', 1)->first();
                if (!$curso) {
                    return response()->json(['message' => 'error_course']);
                }

                $getFavorito = Favorito::where('user_id', auth()->user()->id)
                                        ->where('curso_id', $curso->id)->first();

                if ($getFavorito) {

                    $favorito = Favorito::find($getFavorito->id);
                    if ($favorito->delete()) {
                        DB::commit();
                        return response()->json(['message' => 'ok']);
                    }

                    DB::rollback();
                    return response()->json(['message' => 'error']);
                }

                DB::rollback();
                return response()->json(['message' => 'error']);
            }
            else if ($request->seccion == "evento") {
                DB::beginTransaction();

                $evento = Evento::where('slug', $request->slug)->where('status', 1)->first();
                if (!$evento) {
                    return response()->json(['message' => 'error_event']);
                }

                $getFavorito = Favorito::where('user_id', auth()->user()->id)
                                    ->where('evento_id', $evento->id)->first();

                if ($getFavorito) {
                    $favorito = Favorito::find($getFavorito->id);
                    if ($favorito->delete()) {
                        DB::commit();
                        return response()->json(['message' => 'ok']);
                    }

                    DB::rollback();
                    return response()->json(['message' => 'error']);
                }

                DB::rollback();
                return response()->json(['message' => 'error']);
            }

            return response()->json(['message' => 'error_seccion']);
        }

        return response()->json(['message' => 'error_parameters']);
    }
}
