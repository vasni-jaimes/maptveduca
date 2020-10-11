<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = "instructors";

    public function Cursos()
    {
    	return $this->belongsToMany('App\Course', 'courses_instructors');
    }
}
