<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mensaje extends Model
{
    protected $table = "mensajes";

    public function usuario()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function admin()
    {
    	return $this->hasOne('App\Administrator', 'id', 'admin_id');
    }

    public function FormatoLetras($fecha)
    {
    	$meses 	= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha 	= Carbon::parse($fecha);
		$mes 	= $meses[($fecha->format('n')) - 1];

		return $fecha->format('d').'/'.$mes.'/'.$fecha->format('Y').' '.$fecha->format('H').':'.$fecha->format('i').'hrs';
	}
}
