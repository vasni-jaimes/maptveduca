<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use App\Mensaje;
use App\Notificacion;
use App\UsuarioMembresia;
use DB;

class User extends Authenticatable
{
    use Notifiable;


    public function suscripcion()
    {
        return $this->belongsToMany('App\Membresia', 'usuarios_membresia', 'user_id', 'membresia_id');
    }

    public function tablero_cursos()
    {
        return $this->belongsToMany('App\Course', 'tablero_cursos', 'user_id', 'curso_id');
    }

    public function tablero_eventos()
    {
        return $this->belongsToMany('App\Evento', 'tablero_eventos', 'user_id', 'evento_id');
    }


    public function ultimaSuscripcion()
    {
        return $this->suscripcion[count($this->suscripcion) - 1];
    }

    public function miUltimaSuscripcion()
    {
        $suscripcion2 = UsuarioMembresia::with("membresia")
                                        ->where('user_id', $this->id)
                                        ->first();

        return $suscripcion2;
    }


    public function primeraSuscripcion()
    {
        return $this->suscripcion[0];
    }

    public function tieneSuscripcion()
    {
        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d');

        $suscripcion2 = UsuarioMembresia::with("membresia")
                                        ->where('fecha_fin', '>', $hoy)
                                        ->where('fehca_inicio', '<=', $hoy)
                                        ->where('user_id', $this->id)
                                        ->first();

        return $suscripcion2;
    }

    public function contadorDiasSuscripcion()
    {
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d');

        $suscripcion = $this->tieneSuscripcion();
        $fecha1      = new \DateTime($hoy);
        $fecha2      = new \DateTime($suscripcion->fecha_fin);
        $diff        = $fecha1->diff($fecha2);

        // El resultados sera 3 dias
        return $diff->days;
        //return $this->dias_pasados($suscripcion->fecha_inicio, $suscripcion->fecha_fin);
    }



    /*protected function dias_pasados($fecha_inicial,$fecha_final)
    {   
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias); $dias = floor($dias);
        return $dias;
    }*/


    public function MensajesNotify()
    {
        $contMsj = Mensaje::where('user_id', $this->id)->where('pendiente', 1)->count();
        $contNotify = Notificacion::where('user_id', $this->id)->where('pendiente', 1)->count();
        $total = $contMsj + $contNotify;

        if ($total <= 0) {
            return false;
        }

        return $total;
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password', 'apaterno', 'amaterno', 'fecha_nacimiento',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
