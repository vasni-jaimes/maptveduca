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
}
