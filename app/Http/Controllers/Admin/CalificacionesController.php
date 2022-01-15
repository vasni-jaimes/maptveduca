<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\User;
use App\Recomendacion;
use App\Calificacion;
use App\Course;
use App\Instructor;
use DB;

class CalificacionesController extends Controller
{
    public function __construct(Helper $helper)
    {
        $this->middleware("authadmin:auth");
        $this->middleware(["role:profesor_lider|director,admins"]);
    	$this->helper = $helper;
    }


    public function index()
    {
    	//FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d');

        $helper = $this->helper;
    	$alumnos = DB::table('users')
    					->join('usuarios_membresia', 'users.id', 'usuarios_membresia.user_id')
    					->select('users.*')
    					->where('usuarios_membresia.fehca_inicio', '<=', $hoy)
    					->where('usuarios_membresia.fecha_fin', '>', $hoy)
                        ->where('usuarios_membresia.membresia_id', 2)
    					->where('users.status', 1)
                        ->groupBy('users.id')
    					->get();


    	return view('admin.calificaciones-alumnos', compact('alumnos', 'helper'));
    }


    public function getMaterias($alumno_id)
    {
        $user = User::where('id', $alumno_id)->first();
        if (!$user->tieneSuscripcion() || $user->ultimaSuscripcion()->id != 2) {
            return redirect()->route('calificaciones-alumnos');
        }

        $cursos = $this->cursosPorTrimestre($user);

        return view('admin.calificaciones-materias', compact('cursos', 'alumno_id', 'user'));
    }

    public function getCalificaciones($alumno_id, $slug_curso)
    {
        $califi          = array();
        $user            = User::where('id', $alumno_id)->first();
        $curso           = Course::where('slug', $slug_curso)->where('status', 1)->first();
        $trimestreAlumno = $this->helper->istrimestre($user->grupo_id);
        $calificaciones  = Calificacion::where('user_id', $user->id)
                                ->where('curso_id', $curso->id)->get();

        foreach ($calificaciones as $calificacion) {

            if ($calificacion->trimestre == 1) {
                $califi["primero"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 2) {
                $califi["segundo"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 3) {
                $califi["tercero"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 4) {
                $califi["cuarto"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 5) {
                $califi["quinto"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 6) {
                $califi["sexto"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 7) {
                $califi["septimo"] = $calificacion->calificacion;
            }

            if ($calificacion->trimestre == 8) {
                $califi["octavo"] = $calificacion->calificacion;
            }
            
        }

        //return $califi["tercero"];


        return view('admin.calificaciones', compact("trimestreAlumno", "calificaciones", "curso", "user", "alumno_id", "slug_curso", "califi"));
    }


    public function storeCalificaciones(Request $request, $user_id, $slug_curso)
    {
        if (isset($user_id) && isset($slug_curso)) {

            $curso = Course::where('slug', $slug_curso)->where('status', 1)->first();

            DB::beginTransaction();
            
            if ($request->has('calificacion_uno') && isset($request->calificacion_uno)) {

                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 1)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 1;
                    $calificacion->calificacion = $request->calificacion_uno;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 1;
                    $calificacion->calificacion = $request->calificacion_uno;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_dos') && isset($request->calificacion_dos)) {
                
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 2)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 2;
                    $calificacion->calificacion = $request->calificacion_dos;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 2;
                    $calificacion->calificacion = $request->calificacion_dos;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_tres') && isset($request->calificacion_tres)) {

                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 3)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 3;
                    $calificacion->calificacion = $request->calificacion_tres;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 3;
                    $calificacion->calificacion = $request->calificacion_tres;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_cuatro') && isset($request->calificacion_cuatro)) {
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 4)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 4;
                    $calificacion->calificacion = $request->calificacion_cuatro;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 4;
                    $calificacion->calificacion = $request->calificacion_cuatro;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_cinco') && isset($request->calificacion_cinco)) {
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 5)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 5;
                    $calificacion->calificacion = $request->calificacion_cinco;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 5;
                    $calificacion->calificacion = $request->calificacion_cinco;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_seis') && isset($request->calificacion_seis)) {
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 6)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 6;
                    $calificacion->calificacion = $request->calificacion_seis;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 6;
                    $calificacion->calificacion = $request->calificacion_seis;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_siete') && isset($request->calificacion_siete)) {
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 7)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 7;
                    $calificacion->calificacion = $request->calificacion_siete;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 7;
                    $calificacion->calificacion = $request->calificacion_siete;
                    $calificacion->save();
                }
            }

            if ($request->has('calificacion_ocho') && isset($request->calificacion_ocho)) {
                $calificacion = Calificacion::where('user_id', $user_id)
                                    ->where('curso_id', $curso->id)->where('trimestre', 8)->first();

                if ($calificacion) {
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 8;
                    $calificacion->calificacion = $request->calificacion_ocho;
                    $calificacion->save();
                }
                else {
                    $calificacion = new Calificacion();
                    $calificacion->user_id = $user_id;
                    $calificacion->curso_id = $curso->id;
                    $calificacion->trimestre = 8;
                    $calificacion->calificacion = $request->calificacion_ocho;
                    $calificacion->save();
                }
            }

            DB::commit();
            return back()->with("status.calificacion", "success");
        }

        DB::rollback();
        return back()->with("status.calificacion", "error");
    }


    protected function cursosPorTrimestre($user)
    {
        $trimestre       = $this->helper->istrimestre($user->grupo_id);
        $recomendaciones = Recomendacion::with(['cursos' => function($query){
                                    $query->where('status', 1);
                                    if (Auth::guard('admins')->user()->hasRole('profesor_lider')) {
                                        $query->where('categoria_id', Auth::guard('admins')->user()->categoria_id);
                                    }
                                }])
                                ->where('carrera_id', $user->tieneSuscripcion()->carrera_id)
                                ->where('trimestre', $trimestre)
                                ->get();

        return $recomendaciones->where('cursos', '!=', null);
    }
}
