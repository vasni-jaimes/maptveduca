<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = "/admin/listado-usuarios";

    public function __construct()
    {
       $this->middleware("authadmin:guest", ["only" => ["showLoginForm"]]);
    }

    protected function guard()
    {
        return Auth::guard('admins');
    }
    
    public function showLoginForm()
    {
    	return view("admin.login");
    }
    
}
