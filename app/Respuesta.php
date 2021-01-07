<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = "aulas_respuestas";


    public function instructor()
    {
    	return $this->hasOne('App\Instructor', 'id', 'instructor_id');
    }


    public function usuario()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
