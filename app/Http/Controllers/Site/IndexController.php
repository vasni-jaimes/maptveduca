<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instructor;

class IndexController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest');
    }
	
    public function showIndex()
    {
    	$instructores   = Instructor::where("status", 1)->get();
    	return view("site.index", compact("instructores"));
    }
}
