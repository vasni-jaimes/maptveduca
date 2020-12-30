<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableroCursos extends Model
{
    protected $table = "tablero_cursos";

    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }
}
