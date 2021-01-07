<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = "aulas_publicacion_create";

    public function instructor()
    {
    	return $this->hasOne('App\Instructor', 'id', 'instructor_id');
    }
}
