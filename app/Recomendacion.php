<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendacion extends Model
{
    protected $table = "recomendaciones";

    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }


    public function obtenerCalificacion()
    {
    	$calif = Calificacion::where('user_id', auth()->user()->id)
    				->where('curso_id', $this->curso_id)
    				->where('trimestre', $this->trimestre)->first();

    	if ($calif) {
    		return $calif->calificacion == 0 ? false : $calif->calificacion;
    	}

    	return false;
    }
}
