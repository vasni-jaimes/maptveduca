<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidarMensajes;
use App\User;
use App\Mensaje;
use Carbon\Carbon;
use App\Course;
use DB;

class MensajesController extends Controller
{
	public function __construct()
	{
		$this->middleware("authadmin:auth");
        $this->middleware(["role:profesor_lider|admin,admins"])->except(["listaMensajes"]);;
	}

    public function listaMensajes()
    {
        $usuarios = User::where('status', 1)->get();

        return view("admin.mensajes.lista-mensajes", compact("usuarios"));
    }
    
    public function mandarMensaje()
    {
    	$usuarios = $this->getMisAlumnos();
        $cursos   = $this->getMaterias();

        //return $usuarios;

    	return view("admin.agregar-mensajes", compact("usuarios", "cursos"));
    }

    public function sendMensaje(ValidarMensajes $request)
    {

        //return $request->has('select_usuarios');

        if ((!$request->has('select_cursos') || !isset($request->select_cursos)) && 
            (!$request->has('select_usuarios') || empty($request->select_usuarios) )) {
            
            $alumnos = $this->getMisAlumnos();

            DB::beginTransaction();
            foreach ($alumnos as $alumno) {
                $mensaje = new Mensaje();
                $mensaje->admin_id = Auth::guard('admins')->user()->id;
                $mensaje->user_id = $alumno->id;
                $mensaje->mensaje = $request->mensaje;
                $mensaje->save();
            }

            DB::commit();
            return back()->with("status.newMensaje", "success");

        }
        else if ((!$request->has('select_cursos') || !isset($request->select_cursos)) && 
            ($request->has('select_usuarios') || !empty($request->select_usuarios) )) {
        

            DB::beginTransaction();
            for ($i = 0; $i <= count($request->select_usuarios) - 1; $i++) {
                $mensaje = new Mensaje();
                $mensaje->admin_id = Auth::guard('admins')->user()->id;
                $mensaje->user_id = $request->select_usuarios[0];
                $mensaje->mensaje = $request->mensaje;
                $mensaje->save();
            }

            DB::commit();
            return back()->with("status.newMensaje", "success");

        }
        else if (($request->has('select_cursos') || isset($request->select_cursos)) && 
            ($request->has('select_usuarios') || !empty($request->select_usuarios) )) {

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
        else if (($request->has('select_cursos') || isset($request->select_cursos)) && 
            (!$request->has('select_usuarios') || empty($request->select_usuarios) )) {

            $tablero = DB::table('tablero_cursos')
                        ->where('curso_id', $request->select_cursos)
                        ->select('user_id')
                        ->get();

            $tablero = collect($tablero)->pluck('user_id')->toArray();
            $alumnos = User::where('status', 1)->whereIn('id', $tablero)->get();

            DB::beginTransaction();
            foreach ($alumnos as $alumno) {
                $mensaje = new Mensaje();
                $mensaje->admin_id = Auth::guard('admins')->user()->id;
                $mensaje->user_id = $alumno->id;
                $mensaje->mensaje = $request->mensaje;
                $mensaje->save();
            }

            DB::commit();
            return back()->with("status.newMensaje", "success");
        }

        DB::rollback();
        return back()->with("status.newMensaje", "error");
    }


    public function searchAlumnos(Request $request)
    {
        if (!$request->has('curso_id')) {
            return response()->json(['message' => 'no_parameters']);
        }

        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d');

        $alumnos = DB::table('tablero_cursos')
                    ->join('users', 'tablero_cursos.user_id', 'users.id')
                    ->join('usuarios_membresia', 'users.id', 'usuarios_membresia.user_id')
                    ->where('usuarios_membresia.fecha_fin', '>', $hoy)
                    ->where('usuarios_membresia.fehca_inicio', '<=', $hoy)
                    ->where('usuarios_membresia.membresia_id', 2)
                    ->where('tablero_cursos.curso_id', $request->curso_id)
                    ->get();

        if ($alumnos->count() > 0) {
            return response()->json(["message" => "ok", "items" => $alumnos->groupBy('user_id')]);
        }

        return response()->json(["message" => "no_results"]);

    }


    public function verMensaje(Request $request)
    {
        if ($request->has('mensaje') && isset($request->mensaje) && is_numeric($request->mensaje)) {
            $mensaje = Mensaje::where('user_id', auth()->user()->id)->where('id', $mensaje)->first();
            if ($mensaje) {
                $mensaje->pendiente = 0;
                if ($mensaje->save()) {
                    return response()->json(['message' => 'ok']);
                }
                
                return response()->json(['message' => 'error']);
            }
            

            return response()->json(['message' => 'error']);
        }
    }


    protected function getMisAlumnos()
    {
        if (Auth::guard('admins')->user()->hasRole(['admin', 'director'])) {
            return User::where('status', 1)->get();
        }

        $cursos = Course::where('categoria_id', Auth::guard('admins')->user()->categoria_id)->get();

        $cursos = collect($cursos)->pluck('id')->toArray();
        $tablero = DB::table('tablero_cursos')
                    ->whereIn('curso_id', $cursos)
                    ->select('user_id')
                    ->get();

        $nuevoTablero = array();
        foreach($tablero as $tableros) {
            $alumno = User::find($tableros->user_id);
            if (@$alumno->tieneSuscripcion()->membresia_id == 2) {
                $nuevoTablero[] = $tableros;
            }
        }

        $tablero = collect($nuevoTablero)->pluck('user_id')->toArray();
        $alumnos = User::where('status', 1)->whereIn('id', $tablero)->get();

        return $alumnos;
    }

    protected function getMaterias()
    {
        if (Auth::guard('admins')->user()->hasRole(['admin', 'director'])) {
            return false;
        }

        $cursos = Course::where('categoria_id', Auth::guard('admins')->user()->categoria_id)->get();

        if ($cursos->count() <= 0) {
            return false;
        }

        return $cursos;
    }
}
