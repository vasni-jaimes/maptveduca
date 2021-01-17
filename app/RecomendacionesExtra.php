<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecomendacionesExtra extends Model
{
    protected $table = "recomendaciones_extra";

    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }
}
