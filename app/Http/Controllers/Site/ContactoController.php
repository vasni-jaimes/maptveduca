<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarContacto;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeContacto;
use App\Contacto;
use DB;

class ContactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ["only" => ["MandarEmail"]]);
    }


    public function index()
    {
    	return view('site.faqs');
    }

    public function store(ValidarContacto $request)
    {
        DB::beginTransaction();

    	$contacto = new Contacto();
    	$contacto->nombre 	= $request->nombre;
    	$contacto->email 	= $request->email;
    	$contacto->ciudad 	= $request->ciudad;
    	$contacto->pais 	= $request->pais;
    	$contacto->mensaje 	= $request->mensaje;
    	if ($contacto->save()) {
            DB::commit();
            $this->MandarEmail($request);
    		return back()->with("status.newContacto", "success");
    	}

        DB::rollback();
    	return back()->with("status.newContacto", "error");
    }



    protected function MandarEmail($request)
    {
        //maptveduca.info@gmail.com
        return Mail::to("maptveduca.info@gmail.com")->send(new MensajeContacto($request));
    }
}
