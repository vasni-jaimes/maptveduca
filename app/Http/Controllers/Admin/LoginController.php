<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Administrator;

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

    protected function attemptLogin(Request $request)
    {
        $usr = Administrator::where('email', $request->email)->where('status', 1)->first();

        if ($usr->rol_id == 2) {
            $this->redirectTo = "/admin/agregar-mensaje";
        }

        if ($usr) {
            return $this->guard()->attempt(
                $this->credentials($request), $request->filled('remember')
            );
        }

        return false;
    }


    public function logout()
    {
        $this->guard()->logout();
        return redirect('/admin');
    }
    
}
