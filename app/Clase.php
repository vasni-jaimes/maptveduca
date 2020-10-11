<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clase extends Model
{
    protected $table = "clases";

    public function instructor()
    {
    	return $this->belongsToMany('App\Instructor', 'clases_instructors', 'clas_id');
    }

    public function sesiones()
    {
    	return $this->hasMany('App\ClaseSesion', 'clas_id');
    }


    public function FormatoTiempo($fecha)
    {
    	//$carbon         = new Carbon();
        return Carbon::parse($fecha)->format('H:i');
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
