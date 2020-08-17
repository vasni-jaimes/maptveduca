<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Decorators\CursosDecorator;
use App\Category;
use App\Http\Requests\ValidateAgregarCurso;
use App\Decorators\CoursesDecorator;
use Illuminate\Support\Facades\Storage;
//HELPERS
use App\Helpers\Helper;
use App\Course;

class CoursesController extends Controller
{

    protected $coursesDecorator;
    protected $helper;

    public function __construct(CoursesDecorator $coursesDecorator, Helper $helper)
    {
        $this->coursesDecorator = $coursesDecorator;
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
        $cursos = Course::with("instructor")->get();
        $helper = $this->helper;
        //return response()->json($cursos);
        return view("admin.listado-cursos", compact("cursos", "helper"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::where('status', 1)->get();
        return view("admin.agregar-curso", compact("categorias"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateAgregarCurso $request)
    {
        //return var_dump($request->file('material_extra'));
        //return response()->json($request);
        return $this->coursesDecorator->AgregarCursoDecore($request);


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
        return view("admin.editar-curso");
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
        return response()->json($request);
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
