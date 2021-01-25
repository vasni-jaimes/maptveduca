<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "careers";


    public function cursos()
    {
    	return $this->hasOne('App\Course', 'id', 'curso_id');
    }
}
