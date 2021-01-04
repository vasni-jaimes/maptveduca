<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Decorators\EventosDecorator;
use App\Http\Requests\ValidarAgregarEvento;
use App\Http\Requests\ValidarUpdateEvento;
use App\Helpers\Helper;
use App\Instructor;
use App\Evento;
use App\TipoEventos;
use App\Notificacion;
use Illuminate\Support\Facades\Validator;
use DB;

class EventosController extends Controller
{

    protected $eventosDecorator;
    protected $helper;

    public function __construct(EventosDecorator $eventosDecorator, Helper $helper)
    {
        $this->eventosDecorator = $eventosDecorator;
        $this->helper           = $helper;
        $this->middleware("authadmin:auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::with("instructor")->get();
        $helper = $this->helper;
        return view("admin.listado-eventos", compact("eventos", "helper"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructores   = Instructor::where('status', 1)->get();
        $tipoeventos    = TipoEventos::where('status', 1)->get();
        return view("admin.agregar-evento", compact("instructores", "tipoeventos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarAgregarEvento $request)
    {
        //return response()->json($request);
        return $this->eventosDecorator->store($request);
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
        $data = $this->eventosDecorator->edit($id);
        return view("admin.editar-evento", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarUpdateEvento $request, $id)
    {
        return $this->eventosDecorator->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function cambiarStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "id"     => "required|string",
            "status" => "required|numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => 'error_input',
                "inputs" => $validator->errors(),
            ], 201);
        }

        $id     = $this->helper::base64_decode_url($request->id);
        $status = $request->status;


        DB::beginTransaction(); 
        $evento          = Evento::findOrFail($id);
        $evento->id      = $id;
        $evento->status = $status;

        if ($evento->save()) {
            $this->sendNotificaciones($evento);
            DB::commit();
            return response()->json(["message" => "ok"]);
        }

        DB::rollback();
        return response()->json(["message" => "error"]);
    }

    protected function sendNotificaciones($evento)
    {
        $notificacion = new Notificacion();
        $notificacion->user_id = 0;
        $notificacion->mensaje = "Se Creeo contenido nuevo, <br> Actualmente se genero un curso nuevo y para verlo solo hay que darle click: <a href='".route("single-cursos.show", $evento->slug)."' target='_blank'>".$evento->nombre."</a>";
        $notificacion->save();
    }
}
