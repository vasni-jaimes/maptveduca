<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class MensajesController extends Controller
{
	public function __construct()
	{
		$this->middleware("authadmin:auth");
	}
    
    public function mandarMensaje()
    {
    	$usuarios = User::where('status', 1)->get();
    	return view("admin.agregar-mensajes", compact("usuarios"));
    }
}
