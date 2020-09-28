<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Decorators\InstructoresDecorator;
use App\Helpers\Helper;
use App\Http\Requests\ValidarAgregarInstructor;
use App\Http\Requests\ValidarEditarInstructor;
use App\Instructor;

class InstructoresController extends Controller
{

    protected $instructoresDecorator;
    protected $helper;

    public function __construct(InstructoresDecorator $instructoresDecorator, Helper $helper)
    {
        $this->instructoresDecorator = $instructoresDecorator;
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
        $instructores   = Instructor::all();
        $helper         = $this->helper;
        return view("admin.lista-instructores", compact("instructores", "helper"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.agregar-instuctor");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarAgregarInstructor $request)
    {
        return $this->instructoresDecorator->store($request);
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
        $id             = $this->helper::base64_decode_url($id);
        $instructor     = Instructor::findOrFail($id);
        $helper         = $this->helper;
        return view("admin.editar-instructor", compact("instructor", "id", "helper"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarEditarInstructor $request, $id)
    {
        return $this->instructoresDecorator->update($request, $id);
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
