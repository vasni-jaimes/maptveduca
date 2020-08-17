<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    public function instructor()
    {
    	return $this->belongsToMany('App\Instructor', 'courses_instructors');
    }
}
