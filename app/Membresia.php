<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = 'membresias';

    public function carreras()
    {
    	return $this->belongsToMany('App\Career', 'membresias_carreras', 'membresia_id', 'carrera_id');
    }
}
