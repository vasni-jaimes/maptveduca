<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidarAgregarUsuarios;
use App\Http\Requests\ValidarUpdateUsuario;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Grupo;
use App\Career;
use App\Mensaje;
use Carbon\Carbon;
use DB;

class UsersController extends Controller
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
        $usuarios = User::orderBy('id', 'desc')->get();
        return view('admin.listado-usuarios', compact("usuarios"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos  = Grupo::all();
        $careers = Career::where('status', 1)->get();
        return view('admin.agregar-usuario', compact("careers", "grupos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarAgregarUsuarios $request)
    {
        DB::beginTransaction();
        $user                   = new User();
        $user->nombre           = $request->nombre;
        $user->amaterno         = $request->amaterno;
        $user->apaterno         = $request->apaterno;
        $user->email            = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimineto;
        $user->grupo_id         = $request->select_grupo;
        $user->password         = Hash::make($request->password);
        $user->status           = 0;
        if ($user->save()) {

            if ($request->has('suscripcion')) {

                //OBTENER MEMBRESIA A PAGAR
                date_default_timezone_set('America/Mexico_City');
                $fecha_inicio   = Carbon::now()->format('Y-m-d');
                $fecha_final    = Carbon::now()->addMonth()->format('Y-m-d');
                
                $user_membresia = DB::table('usuarios_membresia')->insert([
                    "user_id"       => $user->id,
                    "membresia_id"  => 2,
                    "carrera_id"    => $request->select_carreras,
                    "fehca_inicio"  => $fecha_inicio,
                    "fecha_fin"     => $fecha_final,
                ]);

                if ($user_membresia) {
                    $this->MensajeBienvenidaSuscripcion($user);
                    DB::commit();
                    return back()->with("status.newUsuario", "success");
                }

                DB::rollback();
                return back()->withInput()->with("status.newUsuario", "error");
            }
            
            DB::commit();
            return back()->with("status.newUsuario", "success");
        }

        DB::rollback();
        return back()->withInput()->with("status.newUsuario", "error");
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
        $grupos  = Grupo::all();
        $usuario = User::findOrFail($id);
        $careers = Career::where('status', 1)->get();
        return view('admin.editar-usuario', compact("careers", "usuario", "id", "grupos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarUpdateUsuario $request, $id)
    {
        DB::beginTransaction();
        $user                   = User::findOrFail($id);
        $user->nombre           = $request->nombre;
        $user->amaterno         = $request->amaterno;
        $user->apaterno         = $request->apaterno;
        $user->email            = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimineto;
        $user->grupo_id         = $request->select_grupo;

        if ($request->has('password') && isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }

        if ($user->save()) {

            if ($request->has('suscripcion')) {

                if (!$user->tieneSuscripcion()) {
                    //OBTENER MEMBRESIA A PAGAR
                    date_default_timezone_set('America/Mexico_City');
                    $fecha_inicio   = Carbon::now()->format('Y-m-d');
                    $fecha_final    = Carbon::now()->addMonth()->format('Y-m-d');
                    
                    $user_membresia = DB::table('usuarios_membresia')->insert([
                        "user_id"       => $user->id,
                        "membresia_id"  => 2,
                        "carrera_id"    => $request->select_carreras,
                        "fehca_inicio"  => $fecha_inicio,
                        "fecha_fin"     => $fecha_final,
                    ]);

                    if ($user_membresia) {
                        $this->MensajeBienvenidaSuscripcion($user);
                        DB::commit();
                        return back()->with("status.updateUsuario", "success");
                    }

                    DB::rollback();
                    return back()->withInput()->with("status.updateUsuario", "error");
                }

                DB::commit();
                return back()->with("status.updateUsuario", "success");
            }
            else {
                if ($user->tieneSuscripcion()) {
                    date_default_timezone_set('America/Mexico_City');
                    $hoy = Carbon::now()->format('Y-m-d');
                    DB::table('usuarios_membresia')
                                        ->where('fecha_fin', '>', $hoy)
                                        ->where('fehca_inicio', '<=', $hoy)
                                        ->where('user_id', $user->id)
                                        ->delete();
                }
            }
            
            DB::commit();
            return back()->with("status.updateUsuario", "success");
        }

        DB::rollback();
        return back()->withInput()->with("status.updateUsuario", "error");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!isset($id)) {
            return back()->with("status.deleteUsuario", "error");
        }

        $usuario = User::where('id', $id)->first();
        if ($usuario) {
            DB::table('aulas_respuestas')->where('user_id', $usuario->id)->delete();
            DB::table('calificaciones')->where('user_id', $usuario->id)->delete();
            DB::table('eventos_pagados')->where('user_id', $usuario->id)->delete();
            DB::table('eventos_pagados')->where('user_id', $usuario->id)->delete();
            DB::table('favoritos')->where('user_id', $usuario->id)->delete();
            DB::table('mensajes')->where('user_id', $usuario->id)->delete();
            DB::table('notificaciones')->where('user_id', $usuario->id)->delete();
            DB::table('tablero_cursos')->where('user_id', $usuario->id)->delete();
            DB::table('tablero_eventos')->where('user_id', $usuario->id)->delete();
            DB::table('usuarios_membresia')->where('user_id', $usuario->id)->delete();
            
            if ($usuario->delete()) {
                return back()->with("status.deleteUsuario", "success");
            }

            return back()->with("status.deleteUsuario", "error");
        }

        return back()->with("status.deleteUsuario", "error");
    }



    public function cambiarStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id"     => "required|numeric",
            "status" => "required|numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => 'error_input',
                "inputs" => $validator->errors(),
            ], 201);
        }

        $id     = $request->id;
        $status = $request->status;


        DB::beginTransaction(); 
        $user          = User::findOrFail($id);
        $user->status = $status;

        if ($user->save()) {
            DB::commit();
            return response()->json(["message" => "ok"]);
        }

        DB::rollback();
        return response()->json(["message" => "error"]);
    }


    protected function MensajeBienvenidaSuscripcion($usuario)
    {
        $mensaje = new Mensaje();
        $mensaje->admin_id = 1;
        $mensaje->user_id = $usuario->id;
        $mensaje->mensaje = "<strong>Hola ".$usuario->nombre." ".$usuario->apaterno."</strong><br><br>";
        $mensaje->mensaje .= "<br> ¡Enhorabuena! Bienvenid@ a la familia MAPtv Educa. A partir de ahora, disfruta de todo nuestro contenido de cursos. <br><br>

                                Para activar tus cursos, dentro de tu Tablero Personal dirígete al menú “Control Académico” / “Materias” y visita cada uno de los cursos. Dentro de los mismos, da click en “Empezar curso” o navega a través de las sesiones de video.<br><br>

                                Una vez activados tus cursos, dentro de tu Tablero Personal dirígete al menú “Control Académico” / “Aulas Virtuales”. Ahí verás el Aula Virtual de cada una de tus materias. Dentro de cada una tu profesor publicará periódicamente avisos y actividades. En esta sección es donde entregarás tus tareas.<br><br>

                                Para revisar los horarios de las sesiones en Zoom con tus profesores, dentro de tu Tablero Personal dirígete a la sección “Control Académico” / “Materias”. En la parte inferior, da click en cada una de tus materias y se desplegarán los horarios y links a tus sesiones virtuales.<br><br>

                                ¡Disfruta de nuestro contenido! Esperamos tu experiencia sea inigualable.
                                ";

        $mensaje->save();
    }
}
