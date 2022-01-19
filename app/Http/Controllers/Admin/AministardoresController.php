<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidarAgregarAdministrador;
use App\Http\Requests\ValidarUpdateAdministrador;
use App\Helpers\Helper;
use App\Category;
use App\Administrator;
use DB;

class AministardoresController extends Controller
{
    protected $helper;

    public function __construct(Helper $helper)
    {
        $this->middleware("authadmin:auth");
        $this->middleware(["role:admin,admins"]);
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usrAdmin = Administrator::where('status', 1)->get();
        $helper   = $this->helper;
        return view("admin.administradores.listado-administradores", compact("usrAdmin", "helper"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles      = Role::all();
        $categorias = Category::all();

        return view("admin.administradores.agregar-administrador", compact('roles', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarAgregarAdministrador $request)
    {
        DB::beginTransaction();
        $admin               = new Administrator();
        $admin->email        = $request->email;
        $admin->nombres      = $request->nombres;
        $admin->apellidos    = $request->apellidos;

        if ($request->select_roles == 2) {
            $admin->categoria_id = $request->select_categorias;
        }

        $admin->password     = Hash::make($request->password);
        $admin->status       = 1;

        if ($admin->save()) {

            $admin->roles()->attach($request->roles);
            $admin->save();

            DB::commit();
            return back()->with("status.newAdmin", "success");
        }

        DB::rollback();
        return back()->with("status.newAdmin", "error");
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
        $id         = base64_decode($id);
        $admin      = Administrator::with("roles")->where("id", $id)->first();
        $roles      = Role::all();
        $categorias = Category::all();

        return view('admin.administradores.editar-administrador', compact("roles", "admin", "categorias"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarUpdateAdministrador $request, $id)
    {
        $id = base64_decode($id);
        //ACTUALIZAR INSTRUCTOR COMO ADMINISTRADOR
        DB::beginTransaction();
        $admin               = Administrator::findOrFail($id);
        $admin->email        = $request->email;
        $admin->nombres      = $request->nombres;
        $admin->apellidos    = $request->apellidos;
        
         if ($request->select_roles == 2) {
            $admin->categoria_id = $request->select_categorias;
        }

        $admin->roles()->sync($request->select_roles);

        if ($request->has('password') && isset($request->password)) {
            $admin->password = Hash::make($request->password);
        }

        if ($admin->save()) {
            DB::commit();
            return back()->with("status.updateAdmin", "success");
        }

        DB::rollback();
        return back()->with("status.updateAdmin", "success");
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
