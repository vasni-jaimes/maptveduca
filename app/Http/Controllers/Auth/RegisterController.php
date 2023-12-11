<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mensaje;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRegistro;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        return view('site.registro');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apaterno' => ['required', 'string', 'max:255'],
            'amaterno' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function register(Request $request)
    {

        $messages = [
            'g-recaptcha-response.required' => 'Por favor, verifica que no eres un robot.'
        ];

        $this->validate($request, [
            'g-recaptcha-response' => 'required',
        ], $messages);


        $recaptchaSecretKey = env('RECAPTCHA_SECRET_KEY');
        $recaptchaResponse = $request->input('g-recaptcha-response');
        
        $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}");
        $recaptchaData = json_decode($recaptcha);

        if (!$recaptchaData->success) {
            // La validación de reCAPTCHA ha fallado
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'La validación de reCAPTCHA ha fallado.']);
        }



        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return false;
        $usr = User::create([
                    'nombre' => $data['nombre'],
                    'email' => $data['email'],
                    'apaterno' => $data['apaterno'],
                    'amaterno' => $data['amaterno'],
                    'fecha_nacimiento' => $data['fecha_nacimiento'],
                    'password' => Hash::make($data['password']),
                ]);

        if ($usr) {
            $this->MandarEmail($usr);
            $this->sendMensajeBienvenida($usr);
            return $usr;
        }

        return false;
    }


    protected function sendMensajeBienvenida($usr)
    {
        $mensaje = new Mensaje();
        $mensaje->admin_id = 1;
        $mensaje->user_id = $usr->id;
        $mensaje->mensaje = "<strong>Hola ".$usr->nombre." ".$usr->apaterno."</strong>";
        $mensaje->mensaje .= "<br> ¡Bienvenid@ a MAPtv Educa! Navega por nuestra plataforma para descubrir lo que tenemos para ti. Recuerda que para estudiar el Técnico en     Producción Musical a través de nuestros Cursos debes adquirir la Membresía Académica. De otro modo, sólo tendrás acceso a la oferta de Eventos y Clases en Línea.<br><br>

            ¡Visita la sección “Membresía Académica” para conocer más!";
        $mensaje->save();
    }


    protected function MandarEmail($usr)
    {
        try {
             //maptveduca.info@gmail.com
            $email = $usr->email;
            return Mail::to($email)->send(new MailRegistro());
        } catch (\Throwable $th) { return true; }
       
    }
}
