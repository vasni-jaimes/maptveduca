<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
    protected $table = "eventos";

    public function instructor()
    {
    	return $this->belongsToMany('App\Instructor', 'eventos_instructors', 'evento_id');
    }


    public function FormatoLetras($fecha, $index)
    {
    	$meses 	= array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
    	$dias 	= array('DOMINGO', 'LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO');
		$fecha 	= Carbon::parse($fecha);
		$mes 	= $meses[($fecha->format('n')) - 1];

		if ($index == 1) {
			return $dias[$fecha->format('w')].' · '. $fecha->format('d') . ' ' . $mes;
		}
        else if ($index == 3) {
            return $dias[$fecha->format('w')].' · '. $fecha->format('d') . ' ' . $mes . ' '. $fecha->format('Y');
        }

		return $fecha->format('d') . ' ' . $mes;
	}
}
