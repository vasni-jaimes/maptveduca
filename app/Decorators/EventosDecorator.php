<?php

namespace App\Decorators;
use App\Repositories\EventosRepositorie;
use App\Helpers\Helper;
use App\Instructor;
use App\Evento;
use App\TipoEventos;
use Illuminate\Support\Collection;
use DB;


Class EventosDecorator
{
	protected $eventosRepositorie;
	protected $helper;

	public function __construct(EventosRepositorie $eventosRepositorie, Helper $helper)
	{
		$this->eventosRepositorie = $eventosRepositorie;
		$this->helper            = $helper;
	}


	public function store($request)
	{
		return $this->eventosRepositorie->agregarEvento($request);
	}

	public function edit($id)
	{
		$instructors 	= Instructor::where('status', 1)->get();
        $id 		 	= $this->helper::base64_decode_url($id);
       	$evento 		= Evento::with(['instructor'])->findOrFail($id);
       	$myInstructors 	= collect($evento->instructor)->pluck('id')->toArray();
       	$tipoeventos    = TipoEventos::where('status', 1)->get();
       	$helper 		= $this->helper;


       	return array("id" => $id,
       				 "instructors" => $instructors,
       				 "evento" => $evento,
       				 "myInstructors" => $myInstructors,
       				 "tipoeventos" => $tipoeventos,
       				 "helper" => $helper);
	}


	public function update($request, $id)
	{
		$id = $this->helper::base64_decode_url($id);
		return $this->eventosRepositorie->actualzarEvento($request, $id);
	}

}


