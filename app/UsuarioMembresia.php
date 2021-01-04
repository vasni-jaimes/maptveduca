<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsuarioMembresia extends Model
{
    protected $table = "usuarios_membresia";

    public function membresia()
    {
    	return $this->hasOne('App\Membresia', 'id', 'membresia_id');
    }

    public function evento()
    {
    	return $this->hasOne('App\Evento', 'id', 'evento_id');
    }

    public function curso()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }

    public function FormatoLetras($fecha)
    {
    	$fecha 	= Carbon::parse($fecha);
    	$dia 	= $fecha->format('d');
		$mes 	= $fecha->format('m');
		$anio 	= $fecha->format('Y');

		return $dia."/".$mes."/".$anio;
	}

    public function FormatPrecio($total)
    {
        return number_format($total, 2, '.', ',');
    }
}
