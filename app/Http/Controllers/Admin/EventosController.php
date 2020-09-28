<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Decorators\EventosDecorator;
use App\Helpers\Helper;
use App\Category;
use App\Instructor;
use App\Evento;

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
        $categorias     = Category::where('status', 1)->get();
        $instructores   = Instructor::where('status', 1)->get();
        return view("admin.agregar-evento", compact("categorias", "instructores"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function update(Request $request, $id)
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
}
