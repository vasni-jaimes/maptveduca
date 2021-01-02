<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidarMensajes;
use App\User;
use App\Mensaje;
use DB;

class MensajesController extends Controller
{
	public function __construct()
	{
		$this->middleware("authadmin:auth");
	}
    
    public function mandarMensaje()
    {
    	$usuarios = $this->getMisAlumnos();
    	return view("admin.agregar-mensajes", compact("usuarios"));
    }

    public function sendMensaje(ValidarMensajes $request)
    {
        DB::beginTransaction();
        for ($i=0; $i <= count($request->select_usuarios) - 1; $i++) { 
            $mensaje = new Mensaje();
            $mensaje->admin_id = Auth::guard('admins')->user()->id;
            $mensaje->user_id = $request->select_usuarios[$i];
            $mensaje->mensaje = $request->mensaje;
            $mensaje->save();
        }

        DB::commit();
        return back()->with("status.newMensaje", "success");
    	 
    }


    protected function getMisAlumnos()
    {
        if (Auth::guard('admins')->user()->rol_id == 1) {
            return User::where('status', 1)->get();
        }

        $cursos = DB::table('courses_instructors')
                    ->where('instructor_id', Auth::guard('admins')->user()->instructor_id)
                    ->get();

        $cursos = collect($cursos)->pluck('id')->toArray();
        $tablero = DB::table('tablero_cursos')
                    ->whereIn('curso_id', $cursos)
                    ->select('user_id')
                    ->get();
        $tablero = collect($tablero)->pluck('user_id')->toArray();

        $alumnos = User::where('status', 1)->whereIn('id', $tablero)->get();

        return $alumnos;

    }
}
