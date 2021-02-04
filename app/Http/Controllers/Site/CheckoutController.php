<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;
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
use Carbon\Carbon;
use DB;

class CheckoutController extends Controller
{
	private $apiContext;

	public function __construct()
	{
        $this->middleware('auth');

		$payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
	}

    public function index($slug_membresia)
    {
    	$membresia = Membresia::with("carreras")->where('slug', $slug_membresia)->first();
        return view("site.checkout", compact("membresia"));
        //return redirect()->route("home");
    }


    public function getGracias(Request $request)
    {   
        if (!session()->has('gracias')) {
            return redirect()->route("home");
        }

        return view("site.gracias");
    }


    public function PayWithPaypal(Request $request, $slug_membresia)
    {
         //return redirect()->route("home");

    	if ($this->validarMembresiaUsuario()){
            return back()->withInput()->with("error", "El usuario ya cuenta con una suscripcion activa");
    	}

    	//OBTENER MEMBRESIA A PAGAR
    	$membresia = Membresia::where('slug', $slug_membresia)->first();

    	//SI LA MEMBRESIA ES ACADEMICA, VALIDAMOS PARAMETROS
    	if ($membresia->id == 2) {
    		$career = Career::where('id', $request->carrera)->first();

	     	if (!$request->has('carrera') && $membresia->id == 2) {
                return back()->withInput()->with("error", "No esta el parametro necesario");
	    	}

	    	if (!is_numeric($request->carrera)) {
                return back()->withInput()->with("error", "El parametro no es valido");	
	    	}

	    	if (collect($career)->isEmpty()) {
                return back()->withInput()->with("error", "Ocurrio un problema, intentelo más tarde");
	    	}
    	}




    	$payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($membresia->precio);
        $amount->setCurrency('MXN');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = route("pago-status", $slug_membresia);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl."?carrera=".$request->carrera)
            ->setCancelUrl($callbackUrl."?carrera=".$request->carrera);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }


    public function PaypalStatus(Request $request, $slug_membresia)
    {
    	$paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            return redirect()->route("checkout", $slug_membresia)->with("error", "Lo sentimos! El pago a través de PayPal no se pudo realizar.");
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {

        	//OBTENER MEMBRESIA A PAGAR
            date_default_timezone_set('America/Mexico_City');
        	$membresia 		= Membresia::where('slug', $slug_membresia)->first();
        	$carrera 		= $request->has("carrera") ? $request->carrera : null;
        	$fecha_inicio 	= Carbon::now()->format('Y-m-d');
        	$fecha_final	= Carbon::now()->addMonth()->format('Y-m-d');

        	//CREAR REGISTRO
            DB::beginTransaction();
        	$user_membresia = DB::table('usuarios_membresia')->insert([
        		"user_id" 		=> auth()->user()->id,
        		"membresia_id" 	=> $membresia->id,
        		"carrera_id" 	=> $carrera,
        		"fehca_inicio" 	=> $fecha_inicio,
        		"fecha_fin" 	=> $fecha_final,
        	]);


        	if ($user_membresia) {
                $this->MensajeBienvenidaSuscripcion();
                DB::commit();
                return redirect()->route("gracias")->with("gracias", "Gracias! El pago a través de PayPal se ha ralizado correctamente.");
        	}
        }
        
        DB::rollback();
        return redirect()->route("checkout", $slug_membresia)->with("error", "Lo sentimos! El pago a través de PayPal no se pudo realizar.");
    }


    public function validarMembresiaUsuario()
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
}
