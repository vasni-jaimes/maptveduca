<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Config;
use App\Administrator;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = "/admin/dashboard";

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

        if ($usr) {

            if ($usr->rol_id == 2) {
                $this->redirectTo = "/admin/dashboard";
            }

            if ($usr) {
                return $this->guard()->attempt(
                    $this->credentials($request), $request->filled('remember')
                );
            }
        }

        return false;
    }


    public function logout()
    {
        $this->guard()->logout();
        return redirect('/admin');
    }


    public function login(Request $request)
    {

        $messages = [
            'g-recaptcha-response.required' => 'Por favor, verifica que no eres un robot.'
        ];

        $this->validate($request, [
            'g-recaptcha-response' => 'required',
        ], $messages);


        $recaptchaSecretKey = Config::get('recaptcha')['recaptcha_secret_key'];
        $recaptchaResponse = $request->input('g-recaptcha-response');
        
        $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}");
        $recaptchaData = json_decode($recaptcha);

        if (!$recaptchaData->success) {
            // La validación de reCAPTCHA ha fallado
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'La validación de reCAPTCHA ha fallado.']);
        }
        


        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
}
