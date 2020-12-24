<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = "favoritos";

    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }

    public function eventos()
    {
    	return $this->hasOne('App\Evento', 'id', 'evento_id');
    }

    public function clases()
    {
    	return $this->hasOne('App\Clase', 'id', 'clase_id');
    }
}
