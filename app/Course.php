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

    public function category()
    {
    	return $this->belongsToMany('App\Category', 'courses_categories');
    }

    public function careers()
    {
    	return $this->belongsToMany('App\Career', 'courses_careers');
    }
}
