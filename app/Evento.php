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

    public function isArchivado()
    {
        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d H:i:s');


        if ($this->fecha_lanzamiento <= $hoy) {
            return true;
        }

        return false;
    }

    public function FormatPrecio($total)
    {
        return number_format($total, 2, '.', ',');
    }

    public function FormatoLetras($fecha, $index)
    {
    	$meses 	= array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
    	$dias 	= array('DOMINGO', 'LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO');
		$fecha 	= Carbon::parse($fecha);
		$mes 	= $meses[($fecha->format('n')) - 1];

		if ($index == 1) {
			return $dias[$fecha->format('w')].' · '. $fecha->format('d') . ' ' . $mes.' '.$fecha->format('H').':'.$fecha->format('i').' HRS';
		}
        else if ($index == 0) {
            return $dias[$fecha->format('w')].' · '. $fecha->format('d') . ' ' . $mes;
        }
        else if ($index == 3) {
            return $dias[$fecha->format('w')].' · '. $fecha->format('d') . ' ' . $mes . ' '. $fecha->format('Y'). ', '.$fecha->format('H').':'.$fecha->format('i').'HRS';
        }

		return $fecha->format('d') . ' ' . $mes;
	}
}
