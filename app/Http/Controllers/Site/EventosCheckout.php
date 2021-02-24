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
use App\Evento;
use App\Membresia;
use App\Mensaje;
use App\Career;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroEvento;

class EventosCheckout extends Controller
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


	public function PayWithPaypal(Request $request, $slug_evento)
    {
        //VALIDAR SI EL CURSO YA FUE PAGADO ANTERIORMETE 
    	if ($this->validarEvento($slug_evento)){
            return back()->with("error", "El usuario ya cuenta con este evento");
    	}

    	//OBTENER MEMBRESIA A PAGAR
    	$evento = Evento::where('slug', $slug_evento)->first();


        //VALIDAR SI EL EVENTO ESTA EN EL TABLERO DEL USUARIO
        $cursoTablero = DB::table('tablero_eventos')
                                    ->where('evento_id', $evento->id)
                                    ->where('user_id', auth()->user()->id)
                                    ->first();

        if ($cursoTablero) {
            return redirect()->route("evento.show", $slug_evento)->with("error", "Lo sentimos! El evento ya esta registrado en tu tablero");
        }


    	$payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($evento->precio);
        $amount->setCurrency('MXN');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Evento: '. $evento->nombre);

        $callbackUrl = route("pagoevento-status", $slug_evento);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

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



    public function PaypalStatus(Request $request, $slug_evento)
    {
    	$paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            return redirect()->route("evento.show", $slug_evento)->with("error", "Lo sentimos! El pago a través de PayPal no se pudo realizar.");
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {

        	//OBTENER MEMBRESIA A PAGAR
            date_default_timezone_set('America/Mexico_City');

            //OBTENER EL EVENTO
        	$evento 		= Evento::where('slug', $slug_evento)->first();


        	//CREAR REGISTRO
            DB::beginTransaction();
        	$eventos_pagados = DB::table('eventos_pagados')->insert([
        		"user_id" 		=> auth()->user()->id,
        		"evento_id" 	=> $evento->id,
        	]);

            //CREAR REGISTRO EN EL TABLERO DEL USUARIO
            $tablero = DB::table('tablero_eventos')->insert([
                                "user_id" => auth()->user()->id,
                                "evento_id" => $evento->id,
                                "progreso" => 0
                            ]);



        	if ( $eventos_pagados == true && $tablero == true ) {
                //$this->MandarEmail($evento, "Pagado");
                DB::commit();
                return redirect()->route("evento.show", $slug_evento)->with("gracias", "Gracias! El pago a través de PayPal se ha ralizado correctamente.");
        	}
        }
        
        DB::rollback();
        return redirect()->route("evento.show", $slug_evento)->with("error", "Lo sentimos! El pago a través de PayPal no se pudo realizar.");
    }

    protected function validarEvento($slug_evento)
    {
        $evento = Evento::where('slug', $slug_evento)->first();
        return DB::table('eventos_pagados')->where('evento_id', $evento->id)->where('user_id', auth()->user()->id)->count();
    }

    protected function MandarEmail($evento, $status)
    {
        //maptveduca.info@gmail.com
        $email = auth()->user()->email;
        return Mail::to($email)->send(new RegistroEvento($evento, $status));
    }
}
