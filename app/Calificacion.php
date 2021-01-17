<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = "calificaciones";


    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }
}
