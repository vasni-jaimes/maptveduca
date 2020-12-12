<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;


    public function suscripcion()
    {
        //return DB::table('usuarios_membresia')->where('user_id', $this->id)->first();
        return $this->belongsToMany('App\Membresia', 'usuarios_membresia', 'user_id', 'membresia_id');
    }


    public function tieneSuscripcion()
    {
        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy          = date('Y-m-d');

        $suscripcion2 = DB::table('usuarios_membresia')->where('fecha_fin', '>', $hoy)->where('fehca_inicio', '<=', $hoy)->where('user_id', $this->id)->count();

        return $suscripcion2;
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
}
