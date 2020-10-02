<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = "eventos";

    public function instructor()
    {
    	return $this->belongsToMany('App\Instructor', 'eventos_instructors', 'evento_id');
    }
}
