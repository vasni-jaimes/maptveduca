<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = "notificaciones";

    public function FormatoLetras($fecha)
    {
    	$meses 	= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha 	= Carbon::parse($fecha);
		$mes 	= $meses[($fecha->format('n')) - 1];

		return $fecha->format('d').'/'.$mes.'/'.$fecha->format('Y').' '.$fecha->format('H').':'.$fecha->format('i').'hrs';
	}
}
