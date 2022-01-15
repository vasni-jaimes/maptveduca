<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

//API REST
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

//MODELOS
use App\User;
use App\UsuarioMembresia;
use Carbon\Carbon;
use DB;

class RenovarSuscripcion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renovar:subs';
    private $client;
    private $payPalConfig;
    private $acces_token;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renovar las subscripciones por Paypal o sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->payPalConfig = Config::get('paypal');
        $this->client = new Client([
            "base_uri" => "https://api-m.sandbox.paypal.com",
        ]);

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usuarios = User::where('status', 1)->get();

        foreach ($usuarios as $usuario) {
            if (!$usuario->tieneSuscripcion()) {
                if ($usuario->suscripcion_id != null) {
                    $this->ObtenerAccessToken();
                    $this->obtenerStatus($usuario->suscripcion_id, $usuario);
                }
                else {
                    if ($usuario->renovar == 1) {
                        $this->insertarNuevaSub($usuario);
                    }
                }
            }
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
            var_dump($error);
            //\Log::error($error->message);
            return false;
        }
    }


    protected function obtenerStatus($subscription_id, $usuario)
    {
        try {
            $status = false;
            $res = $this->client->get('/v1/billing/subscriptions/'.$subscription_id, 
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
                    $usuarioMembresia->user_id      = $usuario->id;
                    $usuarioMembresia->membresia_id = $usuario->tieneSuscripcion()->membresia_id;
                    $usuarioMembresia->carrera_id   = $usuario->tieneSuscripcion()->carrera_id;
                    $usuarioMembresia->fehca_inicio = $hoy;
                    $usuarioMembresia->fecha_fin    = $final;

                    if ($usuarioMembresia->save()) {
                        DB::commit();
                        $status = true;
                    }

                    DB::rollback();
                }
                else if ($usuario->renovar == 1) {
                    $this->insertarNuevaSub($usuario);
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


    protected function insertarNuevaSub($usuario)
    {
        $status = false;
        if ($usuario->tieneSuscripcion()) {
            //FECHA DE HOY
            date_default_timezone_set('America/Mexico_City');
            $hoy    = Carbon::now()->format('Y-m-d');
            $final  = Carbon::now()->addMonth()->format('Y-m-d');

            DB::beginTransaction();
            $usuarioMembresia               = new UsuarioMembresia();
            $usuarioMembresia->user_id      = $usuario->id;
            $usuarioMembresia->membresia_id = $usuario->tieneSuscripcion()->membresia_id;
            $usuarioMembresia->carrera_id   = $usuario->tieneSuscripcion()->carrera_id;
            $usuarioMembresia->fehca_inicio = $hoy;
            $usuarioMembresia->fecha_fin    = $final;

            if ($usuarioMembresia->save()) {
                DB::commit();
                $status = true;
            }

            DB::rollback();
        }

        return $status; 
    }
}
