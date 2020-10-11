<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = "clases";

    public function instructor()
    {
    	return $this->belongsToMany('App\Instructor', 'clases_instructors', 'clas_id');
    }
}
