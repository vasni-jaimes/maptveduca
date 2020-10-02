<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Decorators\CursosDecorator;
use App\Category;
use App\Instructor;
use App\Career;
use App\Http\Requests\ValidateAgregarCurso;
use App\Http\Requests\ValidateUpdateCurso;
use App\Decorators\CoursesDecorator;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use App\Course;
use App\Subcategoria;
use Illuminate\Support\Facades\Validator;
use DB;

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
        $categorias     = Category::where('status', 1)->get();
        $instructors    = Instructor::where('status', 1)->get();
        $careers        = Career::where('status', 1)->get();
        return view("admin.agregar-curso", compact("categorias", "instructors", "careers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateAgregarCurso $request)
    {
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
        $data = $this->coursesDecorator->edit($id);
        return view("admin.editar-cursos", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateUpdateCurso $request, $id)
    {
        $id = $this->helper::base64_decode_url($id);
        return $this->coursesDecorator->update($request, $id);
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


    public function deleteFile(Request $request)
    {
        if ($request->has('documento')) {
            if (Storage::delete($request->documento)) {
                return response()->json(['message' => 'ok'], 200);
            }
            return response()->json(['message' => 'no_delete'], 200);
        }

        return response()->json(['message' => 'no_parameters'], 200);

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
        $curso          = Course::findOrFail($id);
        $curso->id      = $id;
        $curso->status = $status;

        if ($curso->save()) {
            DB::commit();
            return response()->json(["message" => "ok"]);
        }

        DB::rollback();
        return response()->json(["message" => "error"]);
    }


    public function obtenerSubcategorias(Request $request)
    {
        if ($request->has("categoria")) {
            $subcategoria = Subcategoria::where("status", 1)->where("categoria_id", $request->categoria)->get();
            return response()->json(["message" => "ok", "main" => $subcategoria]);
        }

        return response()->json(["message" => "error"]);
    }
}
