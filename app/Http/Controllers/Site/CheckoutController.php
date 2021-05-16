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

        if ($status->status == 3) {
            $fechas = $this->fechasHabilitar($status);
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
        if (!$this->GenerarProducto()) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }

        //CREAR PLAN DE PAGO CON EL ID DEL PRODUCTO
        if (!$this->GenerarPlanPago()) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }


        return $this->suscripcionPorducto($carrera, $membresia_id);
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

            if ($res->statusCode() == 204) {
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
            \Log::error($error->message);
            return false;
        }
    }


    protected function GenerarProducto()
    {
        try {
            $res = $this->client->post('/v1/catalogs/products', 
                        ['json' => ["name" => "Cursos Maptveduca", 
                                    "description" => "cursos de paga para la plataforma Maptveduca", 
                                    "type" => "DIGITAL",
                                    "category" => "EDUCATIONAL_AND_TEXTBOOKS", 
                                    "image_url" => "https://example.com/streaming.jpg",
                                    "home_url" => "https://maptvduca.valeriastrempler.com/"], 
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



    protected function GenerarPlanPago()
    {

        $countsPagos = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->count();
        $pagos = 24 - $countsPagos;

        try {
            $res = $this->client->post('/v1/billing/plans', 
                        ['json' => ["product_id" => $this->productId,
                                    "name" => "plan mensual a maptvduca",
                                    "description" => "plan de pago mensual para la plataforma maptvduca",
                                    "status" => "ACTIVE",
                                    "billing_cycles" => [
                                        [
                                            "frequency" => ["interval_unit" => "MONTH", "interval_count" => 1],
                                            "tenure_type" => "REGULAR",
                                            "sequence" => 1,
                                            "total_cycles" => $pagos,
                                            "pricing_scheme" => [
                                                "fixed_price" => [
                                                    "value" => "2000", 
                                                    "currency_code" => "MXN"
                                                ],
                                            ],
                                        ]
                                    ],
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


    protected function suscripcionPorducto($carrera, $membresia_id)
    {
        try {

            //FECHA DE HOY
            $nameSub    = auth()->user()->nombre." ".auth()->user()->apaterno;
            $emailSub   = auth()->user()->email;

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
                                        "return_url" => "http://maptvduca.valeriastrempler.com/gracias?cr=".$carrera."&mm=".$membresia_id,
                                        "cancel_url" => "http://maptvduca.valeriastrempler.com/cancelar-suscripcion",
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
                    $usuarioMembresia               = new UsuarioMembresia();
                    $usuarioMembresia->user_id      = auth()->user()->id;
                    $usuarioMembresia->membresia_id = $request->mm;
                    $usuarioMembresia->carrera_id   = $request->cr;
                    $usuarioMembresia->fehca_inicio = $hoy;
                    $usuarioMembresia->fecha_fin    = $final;

                    if ($usuarioMembresia->save()) {
                        $user                             = User::find(auth()->user()->id);
                        $user->suscripcion_id             = $request->subscription_id;

                        if ($user->save()) {
                            DB::commit();
                            $status = true;
                        }
                        DB::rollback();
                    }
                    DB::rollback();
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
}
