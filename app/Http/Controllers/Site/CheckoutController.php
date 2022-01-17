<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailBienvenida;

//API REST
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

// MODELOS
use App\StatusInscripcion;
use App\Membresia;
use App\Mensaje;
use App\Career;
use App\User;
use App\UsuarioMembresia;
use Carbon\Carbon;
use DB;

class CheckoutController extends Controller
{
	//private $apiContext;
    private $client;
    private $payPalConfig;
    private $acces_token;
    private $productId;
    private $plan;


	public function __construct()
	{
        $this->middleware('auth');

		$this->payPalConfig = Config::get('paypal');

        $this->client = new Client([
            "base_uri" => "https://api-m.sandbox.paypal.com",
            //"base_uri" => "https://api-m.paypal.com",
        ]);
	}

    public function index($slug_membresia)
    {
        //SI YA CUENTA CON UNA MEMBRESIA ACTIVA 
        //ENTONCES NO TIENE CASO MANDARLO A LA VISTA DE PAGO (SE REDIRIGE AL HOME)
        if ($this->validarExistenciaMembresiaUsuario()) {
            return redirect()->route('home');
        }


        $status = StatusInscripcion::first();
        $fechas = null;

        if ($status) {
            if ($status->status == 3) {
                $fechas = $this->fechasHabilitar($status);
            }
        } 

    	$membresia = Membresia::with("carreras")->where('slug', $slug_membresia)->first();
        return view("site.checkout", compact("membresia", "status", "fechas"));
    }


    public function getGracias(Request $request)
    {
        //VALIDAR SI TIENE ACTIVA UNA MEMBRESIA O EL MES QUE CORRE
        if ($this->validarExistenciaMembresiaUsuario()) {
           return redirect()->route('home');
        }

        //SE GUARDA LA SUBSCRIPCION QUE SE ACABA DE APROBAR
        if ($request->has('subscription_id')) {
            $this->ObtenerAccessToken();
            if ($this->validarMembresiaUsuario($request)) {
                return view("site.gracias");
            }
            
            $membresia = Membresia::where('id', $request->mm)->first();
            return redirect()->route('checkout', $membresia->slug)->withInput()->with("error", "Ocurrio un problema, intentelo más tarde plan");
        }

        $membresia = Membresia::where('id', $request->mm)->first();
        return redirect()->route('checkout', $membresia->slug)->withInput()->with("error", "Ocurrio un problema, intentelo más tarde plan");
    } 


    //MAIN
    public function PayWithPaypal($slug_membresia, Request $request)
    {
        //OBTENER CARRERA Y MEMBRESIA
        $membresia      = Membresia::with("carreras")->where('slug', $slug_membresia)->first();
        $carrera        = $request->carrera;
        $membresia_id   = $membresia->id;


        //OBTENER EL TOKEN DEL API
        if (!$this->ObtenerAccessToken()) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }

        //CREAR UN PRODUCTO DIGITAL
        if (!$this->GenerarProducto($membresia)) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }

        //CREAR PLAN DE PAGO CON EL ID DEL PRODUCTO
        $promocion = $request->has('promocion') ? 1 : null;

        if (!$this->GenerarPlanPago($membresia->precio, $membresia->id, $promocion)) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }

        return $this->suscripcionPorducto($carrera, $membresia_id, $promocion);
    }


    public function cancelarSubscripcionView()
    {
        return view('site.infoCancelacion');
    }


    public function cancelarSubscripcion($id_subscripcion)
    {

        $this->ObtenerAccessToken(); //OBTENER TOKEN PARA CONSUMIR API PAYPAL

        //VALIDAR SI LA SUBSCRIPCION YA FUE CANCELADA ANTES PARA REDIRIGIR AL HOME.
        if ($this->isCancelSubscription($id_subscripcion, "CANCELLED")) {
            return redirect()->route('home');
        }

        //SI LA SUBSCRIPCION NO FUE CANCELADA ANTES, SE CANCELA Y SE MUESTRA LA VISTA DE CANCELACION.
        if ($this->ApiCancelSubs($id_subscripcion)) {
            return view("site.cancelarsubscription");
        }

        //.
        return redirect()->route('home');
    }


    protected function ApiCancelSubs($id_subscripcion)
    {
        try {
            $res = $this->client->post('/v1/billing/subscriptions/'.$id_subscripcion.'/cancel', 
                                            ['json' => ["reason" => "no comment"],
                                                'headers' => ['content-type' => 'application/json',
                                                                'authorization' => 'Bearer '.$this->acces_token]
                                            ]
                                    );

            if ($res->getStatusCode() == 204) {

                DB::table('usuarios_membresia')->where('id', auth()->user()->tieneSuscripcion()->id)->update(['canceled_sub' => 1]);
               return true;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }

    protected function ObtenerAccessToken()
    {
        try {
            $res = $this->client->post('/v1/oauth2/token', 
                                            ['auth' => [$this->payPalConfig['client_id'], $this->payPalConfig['secret']],
                                            'form_params' => ['grant_type' => 'client_credentials']]);

            if ($res->getReasonPhrase() == 'OK') {
                $respuesta          = json_decode($res->getBody()->getContents());
                $this->acces_token  = $respuesta->access_token;

                return true;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error("no se puede agregar el token");
            return false;
        }
    }


    protected function GenerarProducto($membresia)
    {
        try {
            $res = $this->client->post('/v1/catalogs/products', 
                        ['json' => ["name" => "Cursos Maptveduca ( ".$membresia->nombre." )", 
                                    "description" => "cursos de paga para la plataforma Maptveduca", 
                                    "type" => "DIGITAL",
                                    "category" => "EDUCATIONAL_AND_TEXTBOOKS", 
                                    "image_url" => "http://ec2-52-204-254-8.compute-1.amazonaws.com/site/img/logo-amarillo.png",
                                    "home_url" => "http://ec2-52-204-254-8.compute-1.amazonaws.com/"], 
                         'headers' => ['content-type' => 'application/json',
                                    'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );

            if ($res->getReasonPhrase() == 'Created') {
                $respuesta       = json_decode($res->getBody()->getContents());
                $this->productId = $respuesta->id;
                return true;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }



    protected function GenerarPlanPago($precio, $membresia_id, $promocion)
    {

        $countsPagosMA        = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->where('membresia_id', 2)->count();
        $countsPagosMB        = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->where('membresia_id', 1)->count();

        $pagosMA              = 24 - $countsPagosMA;
        $pagosTOtales         = $countsPagosMA + $countsPagosMB; //se usa para saber si son nuevos en la plataforma


        $opcionesMembresia  = $membresia_id == 1 
                                ? $this->arrayMembresiaBasica($precio, $pagosTOtales, $promocion) 
                                : $this->arrayMembresiaAcademica($pagosMA, $precio);

        try {
            $res = $this->client->post('/v1/billing/plans', 
                        ['json' => ["product_id" => $this->productId,
                                    "name" => "Plan mensual a maptvduca",
                                    "description" => "plan de pago mensual para la plataforma maptvduca",
                                    "status" => "ACTIVE",
                                    "billing_cycles" => $opcionesMembresia,
                                    "payment_preferences" => [ 
                                        "auto_bill_outstanding" => true,
                                        "setup_fee_failure_action" => "CONTINUE",
                                        "payment_failure_threshold" => 3, 
                                    ],
                                    "taxes" => ["percentage" => "0", "inclusive" => false],
                                ],
                         'headers' => ['content-type' => 'application/json', 'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );

            if ($res->getReasonPhrase() == 'Created') {
                $respuesta       = json_decode($res->getBody()->getContents());
                $this->plan = $respuesta->id;
                return true;
            }
            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }


    protected function suscripcionPorducto($carrera, $membresia_id, $promocion)
    {
        try {

            //FECHA DE HOY
            $nameSub    = auth()->user()->nombre." ".auth()->user()->apaterno;
            $emailSub   = auth()->user()->email;
            $parametros = $membresia_id == 2 ? "cr=".$carrera."&mm=".$membresia_id : 
                                                $promocion != null ? "mm=".$membresia_id."&prom=6" : 
                                                "mm=".$membresia_id;


            $res = $this->client->post('/v1/billing/subscriptions', 
                        ['json' => ["plan_id" => $this->plan,
                                    "subscriber" => [
                                        "name" => ["given_name" => $nameSub],
                                        "email_address" => $emailSub,
                                    ],
                                    "auto_renewal" => true,
                                    "application_context" => [
                                        "brand_name" => "Maptveduca",
                                        "locale" => "en-MX",
                                        "user_action" => "SUBSCRIBE_NOW",
                                        "payment_method" => ["payer_selected" => "PAYPAL", "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"],
                                        "return_url" => "http://ec2-52-204-254-8.compute-1.amazonaws.com/gracias?".$parametros,
                                        "cancel_url" => "http://ec2-52-204-254-8.compute-1.amazonaws.com/cancelar-suscripcion",
                                    ],
                                ], 
                         'headers' => ['content-type' => 'application/json',
                                    'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );


            if ($res->getReasonPhrase() == 'Created') {
                $respuesta       = json_decode($res->getBody()->getContents());
                $linkpay         = $respuesta->links[0]->href; 

                return redirect($linkpay);
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde token");
        }
    }


    protected function validarExistenciaMembresiaUsuario()
    {
    	$fecha 	= Carbon::now()->format('Y-m-d');

    	$results = DB::table('usuarios_membresia')
	    			->where("user_id", auth()->user()->id)
	    			->where('fehca_inicio', '<=', $fecha)
	    			->where('fecha_fin', '>', $fecha)
	    			->first();


	    if (collect($results)->isEmpty()) {
	    	return false;
	    }

	    return true;
    }


    protected function validarMembresiaUsuario($request)
    {
        try {
            $status = false;
            $res = $this->client->get('/v1/billing/subscriptions/'.$request->subscription_id, 
                        ['headers' => ['content-type' => 'application/json',
                                        'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );

            if ($res->getReasonPhrase() == 'OK') {
                $respuesta = json_decode($res->getBody()->getContents());
                if ($respuesta->status == "ACTIVE") {
                    //FECHA DE HOY
                    date_default_timezone_set('America/Mexico_City');
                    $hoy    = Carbon::now()->format('Y-m-d');
                    $final  = Carbon::now()->addMonth()->format('Y-m-d');

                    DB::beginTransaction();

                    if ($request->has("prom")) {
                        
                        for ($i=1; $i <= $request->prom; $i++) { 
                            $usuarioMembresia               = new UsuarioMembresia();
                            $usuarioMembresia->user_id      = auth()->user()->id;
                            $usuarioMembresia->membresia_id = $request->mm;
                            $usuarioMembresia->fehca_inicio = $hoy;
                            $usuarioMembresia->fecha_fin    = $final;


                            $hoy = new Carbon($final);
                            $hoy->format('Y-m-d');
                            $final = new Carbon($hoy);
                            $final->addMonth()->format('Y-m-d');

                            $usuarioMembresia->save();
                        }
                    }
                    else {

                        $usuarioMembresia               = new UsuarioMembresia();
                        $usuarioMembresia->user_id      = auth()->user()->id;
                        $usuarioMembresia->membresia_id = $request->mm;

                        if ($request->has("cr")) {
                            $usuarioMembresia->carrera_id   = $request->cr;
                        }
                        
                        $usuarioMembresia->fehca_inicio = $hoy;
                        $usuarioMembresia->fecha_fin    = $final;

                        $usuarioMembresia->save();
                    }


                    $user                             = User::find(auth()->user()->id);
                    $user->suscripcion_id             = $request->subscription_id;
                    $user->promocion                  = $request->has("prom") ? 1 : 0;

                    //AGREGARLE UN GRUPO AL USUARIO SI ES NUEVO y SI ES DE MEMBRESIA ACADEMICA
                    if ($request->mm == 2) {
                        if (auth()->user()->grupo_id == null) {
                            $status = StatusInscripcion::first();
                            $grupos = DB::table('grupos_inscripciones')->get();

                            foreach ($grupos as $grupo) {
                                $cupo = User::where('grupo_id', $grupo->grupo_id)->count();

                                if ($cupo < 30) {
                                    $user->grupo_id = $grupo->grupo_id;
                                    break;
                                }
                            }
                        }
                    }
                    else {
                        $user->grupo_id = null;
                    }

                    if ($user->save()) {
                        DB::commit();
                        $status = true;
                    }
                    else {
                        DB::rollback();
                    }
                }
            }

            return $status;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }



    protected function isCancelSubscription($subscription_id, $status)
    {
        try {
            $status = false;
            $res = $this->client->get('/v1/billing/subscriptions/'.$subscription_id, 
                        ['headers' => ['content-type' => 'application/json',
                                        'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );

            if ($res->getReasonPhrase() == 'CANCELLED') {
                return true;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }
    

    protected function MensajeBienvenidaSuscripcion()
    {
        $mensaje = new Mensaje();
        $mensaje->admin_id = 1;
        $mensaje->user_id = auth()->user()->id;
        $mensaje->mensaje = "<strong>Hola ".auth()->user()->nombre." ".auth()->user()->apaterno."</strong><br><br>";
        $mensaje->mensaje .= "<br> ¡Enhorabuena! Bienvenid@ a la familia MAPtv Educa. A partir de ahora, disfruta de todo nuestro contenido de cursos. <br><br>

                                Para activar tus cursos, dentro de tu Tablero Personal dirígete al menú “Control Académico” / “Materias” y visita cada uno de los cursos. Dentro de los mismos, da click en “Empezar curso” o navega a través de las sesiones de video.<br><br>

                                Una vez activados tus cursos, dentro de tu Tablero Personal dirígete al menú “Control Académico” / “Aulas Virtuales”. Ahí verás el Aula Virtual de cada una de tus materias. Dentro de cada una tu profesor publicará periódicamente avisos y actividades. En esta sección es donde entregarás tus tareas.<br><br>

                                Para revisar los horarios de las sesiones en Zoom con tus profesores, dentro de tu Tablero Personal dirígete a la sección “Control Académico” / “Materias”. En la parte inferior, da click en cada una de tus materias y se desplegarán los horarios y links a tus sesiones virtuales.<br><br>

                                ¡Disfruta de nuestro contenido! Esperamos tu experiencia sea inigualable.
                                ";

        $mensaje->save();
    }


    protected function MandarEmail()
    {
        //maptveduca.info@gmail.com
        $email = auth()->user()->email;
        return Mail::to($email)->send(new MailBienvenida());
    }


    protected function fechasHabilitar($inscripcion)
    {
        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy    = Carbon::now()->format('Y-m-d');

        $fecha_inicio   = $inscripcion->fecha_inicio;
        $fecha_fin      = $inscripcion->fecha_fin;

        if ($hoy >= $fecha_inicio && $hoy <= $fecha_fin) {
            return true;
        }

        return false;
    } 


    protected function arrayMembresiaBasica($precio, $countsPagos, $promocion)
    {
        if (!$countsPagos) {

            $regalo = $promocion == null ? 1 : 6;

            return  [
                        [
                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                            "tenure_type" => "TRIAL",
                            "sequence" => 1,
                            "total_cycles" => $regalo,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => 0, 
                                    "currency_code" => "MXN"
                                ],
                            ],
                        ],

                        [
                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                            "tenure_type" => "REGULAR",
                            "sequence" => 2,
                            "total_cycles" => 0,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $precio, 
                                    "currency_code" => "MXN"
                                ],
                            ],
                        ], 
                    ];
        }
        else if ($countsPagos && $promocion != null) {


            if (auth()->user()->suscripcion_id != null) {
                $this->ObtenerAccessToken(); //OBTENER TOKEN PARA CONSUMIR API PAYPAL

                if ($this->isCancelSubscription(auth()->user()->suscripcion_id, "CANCELLED")) {
                    //SI LA SUBSCRIPCION NO FUE CANCELADA ANTES, SE CANCELA Y SE MUESTRA LA VISTA DE CANCELACION.
                    $this->ApiCancelSubs(auth()->user()->suscripcion_id);
                }
            }

            $regalo = $promocion == null ? 1 : 6;

            return  [
                        [
                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                            "tenure_type" => "TRIAL",
                            "sequence" => 1,
                            "total_cycles" => $regalo,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => 0, 
                                    "currency_code" => "MXN"
                                ],
                            ],
                        ],

                        [
                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                            "tenure_type" => "REGULAR",
                            "sequence" => 2,
                            "total_cycles" => 0,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $precio, 
                                    "currency_code" => "MXN"
                                ],
                            ],
                        ], 
                    ]; 
        }
        else {

            return  [
                        [
                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                            "tenure_type" => "REGULAR",
                            "sequence" => 1,
                            "total_cycles" => 0,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $precio, 
                                    "currency_code" => "MXN"
                                ],
                            ],
                        ], 
                    ];
        }
    }


     protected function arrayMembresiaAcademica($pagos, $precio)
     {
        return  [
                    [
                        "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                        "tenure_type" => "REGULAR",
                        "sequence" => 1,
                        "total_cycles" => $pagos,
                        "pricing_scheme" => [
                            "fixed_price" => [
                                "value" => $precio, 
                                "currency_code" => "MXN"
                            ],
                        ],
                    ], 
                ];
     }
}
