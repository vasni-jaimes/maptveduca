<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\User;
use DB;

class CalificacionesController extends Controller
{
    public function __construct(Helper $helper)
    {
    	$this->helper = $helper;
        $this->middleware("authadmin:auth");
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
    					->where('users.status', 1)
    					->get();

    	return view('admin.calificaciones-alumnos', compact('alumnos', 'helper'));
    }
}
