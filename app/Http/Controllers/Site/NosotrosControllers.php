<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instructor;

class NosotrosControllers extends Controller
{
    
    public function index()
    {
    	$instructores = Instructor::where("status", 1)->get();
    	//return response()->json($instructores);
    	return view('site.nosotros', compact("instructores"));
    }
}
