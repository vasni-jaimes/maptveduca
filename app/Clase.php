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

    public function category()
    {
    	return $this->belongsToMany('App\Category', 'clases_categories', 'clas_id');
    }
}
