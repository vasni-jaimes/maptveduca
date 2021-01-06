<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidarPerfilEdit;
use App\Favorito;
use App\Recomendacion;
use App\TableroCursos;
use App\TableroEventos;
use App\User;
use App\Mensaje;
use App\UsuarioMembresia;
use App\Notificacion;
use Carbon\Carbon;
use DB;

class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function editar(ValidarPerfilEdit $request)
    {
        DB::beginTransaction();

        $user                   = User::findOrFail(auth()->user()->id);
        $user->nombre           = $request->nombre;
        $user->email            = $request->email;
        $user->amaterno         = $request->amaterno;
        $user->apaterno         = $request->apaterno;
        $user->fecha_nacimiento = $request->fecha_nacimiento;

        if ($request->has('password') && isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            DB::commit();
            return back()->with("status.editPerfil", "success");
        }

        DB::rollback();
        return back()->withInput()->with("status.editPerfil", "error");
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

        /* RECIMENDACIONES */
        $materias        = $this->cursosPorTrimestre();
        $tituloTrimestre = $this->tituloPorTrimestre();

        /* TABLERO CURSOS */

        $tableroCursos = DB::table('tablero_cursos')
                            ->join('courses', 'tablero_cursos.curso_id', 'courses.id')
                            ->select('courses.*')
                            ->where('courses.status', 1)
                            ->where('tablero_cursos.user_id', auth()->user()->id)
                            ->get();

        /* TABLERO EVENTOS */

            //FECHA DE HOY
            date_default_timezone_set('America/Mexico_City');
            $hoy = Carbon::now()->format('Y-m-d');

        $tableroEventos = DB::table('tablero_eventos')
                            ->join('eventos', 'tablero_eventos.evento_id', 'eventos.id')
                            ->select('eventos.*')
                            ->where('eventos.status', 1)
                            ->where('tablero_eventos.user_id', auth()->user()->id)
                            ->where('fecha_lanzamiento', '>', $hoy)
                            ->get();

        $eventosOld = DB::table('tablero_eventos')
                            ->join('eventos', 'tablero_eventos.evento_id', 'eventos.id')
                            ->select('eventos.*')
                            ->where('eventos.status', 1)
                            ->where('tablero_eventos.user_id', auth()->user()->id)
                            ->where('fecha_lanzamiento', '<=', $hoy)
                            ->get();

        /* MENSAJES */
        $mensajes = Mensaje::with(['admin'])
                        ->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        /* HISTORIAL DE PAGOS */
        $pagos = UsuarioMembresia::with(['membresia', 'evento', 'curso'])->get();

        /* NOTIFICACIONES */
        $notificaciones = Notificacion::where('user_id', auth()->user()->id)
                            ->orWhere('user_id', 0)->orderBy('created_at', 'desc')->get();

    	return view('site.micuenta', compact("favoritosCursos", "favoritosEventos", "favoritosClases", "materias", "tableroCursos", "tableroEventos", "eventosOld", "tituloTrimestre", "mensajes", "pagos", "notificaciones"));
    }


    protected function tituloPorTrimestre()
    {
        $pagos = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->get();
        if (count($pagos) <= 3) {
            return "1er Trimestre";
        }
        else if (count($pagos) > 3 && count($pagos) <= 6) {
            return "2do Trimestre";
        }
        else if (count($pagos) > 6 && count($pagos) <= 9) {
            return "3er Trimestre";
        }
        else if (count($pagos) > 9 && count($pagos) <= 12) {
            return "4to Trimestre";
        }
        else if (count($pagos) > 12 && count($pagos) <= 15) {
            return "5to Trimestre";
        }
        else if (count($pagos) > 15 && count($pagos) <= 18) {
            return "6to Trimestre";
        }
        else if (count($pagos) > 18 && count($pagos) <= 21) {
            return "7mo Trimestre";
        }
        else if (count($pagos) > 21 && count($pagos) <= 24) {
            return "8vo Trimestre";
        }
    }

    protected function cursosPorTrimestre()
    {

        $pagos = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->get();

        if (count($pagos) <= 3) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 1)
                        ->get();
        }
        else if (count($pagos) > 3 && count($pagos) <= 6) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 2)
                        ->get();
        }
        else if (count($pagos) > 6 && count($pagos) <= 9) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 3)
                        ->get();
        }
        else if (count($pagos) > 9 && count($pagos) <= 12) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 4)
                        ->get();
        }
        else if (count($pagos) > 12 && count($pagos) <= 15) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 5)
                        ->get();
        }
        else if (count($pagos) > 15 && count($pagos) <= 18) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 6)
                        ->get();
        }
        else if (count($pagos) > 18 && count($pagos) <= 21) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 7)
                        ->get();
        }
        else if (count($pagos) > 21 && count($pagos) <= 24) {
            return Recomendacion::with(['cursos' => function($query){
                            $query->where('status', 1);
                        }])
                        ->where('carrera_id', auth()->user()->obtenerCarrera())
                        ->where('trimestre', 8)
                        ->get();
        }
    }
}
