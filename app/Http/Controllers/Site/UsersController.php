<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidarPerfilEdit;
use App\Helpers\Helper;
use App\TextoAlternativo;
use App\Favorito;
use App\Recomendacion;
use App\TableroCursos;
use App\TableroEventos;
use App\User;
use App\Mensaje;
use App\UsuarioMembresia;
use App\Notificacion;
use App\Calificacion;
use App\CiclosEscolares;
use App\Grupo;
use Carbon\Carbon;
use DB;

class UsersController extends Controller
{

	public function __construct(Helper $helper)
    {
        $this->helper = $helper;
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


        $materias        = null;
        $tituloTrimestre = null;
        $materiasTexto   = null;
        if (auth()->user()->tieneSuscripcion()) {
            /* RECOMENDACIONES */
            $materias        = $this->cursosPorTrimestre();
            $tituloTrimestre = $this->tituloPorTrimestre();
            $materiasTexto   = $this->obtenerTextoAlternativo($materias);
        }

        
            

        /* TABLERO CURSOS */
        $tableroCursos = auth()->user()->tablero_cursos()->where('status', 1)->get();

        /* TABLERO EVENTOS */

        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d H:i:s');


        $tableroEventos = auth()->user()->tablero_eventos()
                            ->where('status', 1)->where('fecha_lanzamiento', '>', $hoy)->get();

        $eventosPasados = auth()->user()->tablero_eventos()
                            ->where('status', 1)->where('fecha_lanzamiento', '<', $hoy)->get();


        /* MENSAJES */
        $mensajes = Mensaje::with(['admin'])
                        ->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        /* HISTORIAL DE PAGOS */
        $pagos = UsuarioMembresia::with(['membresia', 'evento', 'curso'])
                    ->where('user_id', auth()->user()->id)->orderBy('fehca_inicio', 'asc')->get();


        $trimestreActual = null;
        $recomendacionesCompletas = null;
        if (auth()->user()->tieneSuscripcion()) {
            /* CALIFICACIONES */
            $trimestreActual = $this->helper->istrimestre(auth()->user()->grupo_id);
            $recomendacionesCompletas = Recomendacion::with(['cursos'])->where('carrera_id', auth()->user()->tieneSuscripcion()->carrera_id)->get();
        }


        /* NOTIFICACIONES */
        $notificaciones = Notificacion::where('user_id', auth()->user()->id)
                            ->orWhere('user_id', 0)->orderBy('created_at', 'desc')->get();

        /* HELPER */
        $helper = $this->helper;

        /* FECHAS DE INSCRIPCION */
        $grupo = Grupo::where("id", auth()->user()->grupo_id)->first();
        $fechaInscripcion = null;
        if ($grupo) {
            $fechaInscripcion = CiclosEscolares::with(['fechasTrimestres' => function($query) {
                //FECHA DE HOY
                date_default_timezone_set('America/Mexico_City');
                $hoy = Carbon::now()->format('Y-m-d H:i:s');
                $query->where("fecha_inicio", "<=", $hoy);
            }])->where("id", $grupo->ciclo_id)->first();
        }
        


    	return view('site.micuenta', compact("favoritosCursos", "favoritosEventos", "favoritosClases", "materias", "tableroCursos", "tableroEventos", "eventosPasados", "tituloTrimestre", "mensajes", "pagos", "notificaciones", "trimestreActual", "recomendacionesCompletas", "helper", "fechaInscripcion", "materiasTexto"));
    }


    protected function tituloPorTrimestre()
    {
        $trimestre = $this->helper->istrimestre( auth()->user()->grupo_id );
        $titulos = [null, "1er", "2do", "3er", "4to", "5to", "6to", "7mo", "8vo"];

        return $titulos[$trimestre];
    }


    public function verMensaje(Request $request)
    {
        if ($request->has('mensaje') && isset($request->mensaje) && is_numeric($request->mensaje)) {
            $mensaje = Mensaje::where('user_id', auth()->user()->id)->where('id', $request->mensaje)->first();
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


    public function verNotificacion(Request $request)
    {
        if ($request->has('notificacion') && isset($request->notificacion) && is_numeric($request->notificacion)) {
            $notificacion = Notificacion::where('user_id', auth()->user()->id)->where('id', $request->notificacion)->first();
            if ($notificacion) {
                $notificacion->pendiente = 0;
                if ($notificacion->save()) {
                    return response()->json(['message' => 'ok']);
                }
                
                return response()->json(['message' => 'error']);
            }

            return response()->json(['message' => 'error']);
        }
    }


    protected function cursosPorTrimestre()
    {
        $trimestre = $this->helper->istrimestre(auth()->user()->grupo_id);
        return Recomendacion::with(['cursos' => function($query){
                        $query->where('status', 1);
                    }])
                    ->where('carrera_id', auth()->user()->tieneSuscripcion()->carrera_id)
                    ->where('trimestre', $trimestre)
                    ->get();
    }


    protected function obtenerTextoAlternativo($cursos)
    {
        $cursosTexto = array();
        foreach( $cursos as $curso ) {
            $texto = TextoAlternativo::with('cursos')->where('curso_id', $curso->curso_id)->first();
            if ($texto != null) {
                $cursosTexto[] = $texto;
            }
        }
        
        return collect($cursosTexto);
    }


}
