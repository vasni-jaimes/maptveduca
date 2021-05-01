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


use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Membresia;
use App\Mensaje;
use App\Career;
use App\User;
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
        //Obtener token
        $this->ObtenerAccessToken();
        //return $this->acces_token;
        $this->GenerarProducto();
        //return $this->productId;
        $this->GenerarPlanPago();

        //return $this->plan;

        return $this->suscripcionPorducto();


    	$membresia = Membresia::with("carreras")->where('slug', $slug_membresia)->first();
        return view("site.checkout", compact("membresia"));
    }


    public function getGracias(Request $request)
    {   
        // if (!session()->has('gracias')) {
        //     return redirect()->route("home");
        // }

        //return $request;

        if ($request->has('subscription_id')) {
            $this->validarMembresiaUsuario($request->subscription_id);
        }

        echo "ff";
        return false;
        return view("site.gracias");
    }   

    //MAIN
    public function pagoMembresia()
    {
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

        //CREAR SUSCRIPCION CON EL ID DEL PLAN DE PAGO
        if (!$this->suscripcionPorducto()) {
            return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
        }


        return $this->acces_token;
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
                                            "total_cycles" => 24,
                                            "pricing_scheme" => [
                                                "fixed_price" => [
                                                    "value" => "10", 
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


    protected function suscripcionPorducto()
    {
        try {
            $res = $this->client->post('/v1/billing/subscriptions', 
                        ['json' => ["plan_id" => $this->plan, 
                                    "start_time" => "2021-11-01T00:00:00Z", 
                                    "subscriber" => [
                                        "name" => ["given_name" => "Jimena Pruebas"],
                                        "email_address" => "baster07mi@gmail.com",
                                    ],
                                    "auto_renewal" => true,
                                    "application_context" => [
                                        "brand_name" => "Maptveduca",
                                        "locale" => "en-MX",
                                        "user_action" => "SUBSCRIBE_NOW",
                                        "payment_method" => ["payer_selected" => "PAYPAL", "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"],
                                        "return_url" => "http://maptvduca.valeriastrempler.com/gracias",
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
                $suscripcion_id  = $respuesta->id;
                $fecha_creacion  = $respuesta->create_time; 


                //INSERTAR DATOS DE SUSCRIPCION
                $usuario                             = User::find(auth()->user()->id);
                $usuario->suscripcion_id             = $suscripcion_id;
                $usuario->fecha_creacion_suscripcion = $fecha_creacion;
                if ( $usuario->save() ) {
                    return redirect($linkpay);
                }

                return false;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            \Log::error($error->message);
            return false;
        }
    }


    // protected function validarMembresiaUsuario()
    // {
    // 	$fecha 	= Carbon::now()->format('Y-m-d');

    // 	$results = DB::table('usuarios_membresia')
	   //  			->where("user_id", auth()->user()->id)
	   //  			->where('fehca_inicio', '<=', $fecha)
	   //  			->where('fecha_fin', '>', $fecha)
	   //  			->first();


	   //  if (collect($results)->isEmpty()) {
	   //  	return false;
	   //  }

	   //  return true;
    // }


    protected function validarMembresiaUsuario($subscription_id)
    {
        try {
            $res = $this->client->get('/v1/billing/subscriptions/'.$subscription_id, 
                        ['headers' => ['content-type' => 'application/json',
                                        'authorization' => 'Bearer '.$this->acces_token]
                        ]
                    );

            if ($res->getReasonPhrase() == 'Created') {
                $respuesta       = json_decode($res->getBody()->getContents());
                dd($respuesta);
                //$this->productId = $respuesta->id;
                //return true;
            }

            return false;

        } catch (ClientException $e) {
            $responsError = $e->getResponse();
            $error        = json_decode($responsError->getBody()->getContents());
            dd($error);
            //\Log::error($error->message);
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
}
