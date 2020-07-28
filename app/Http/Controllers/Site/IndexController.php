<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest');
    }
	
    public function showIndex()
    {
    	return view("site.index");
    }
}
