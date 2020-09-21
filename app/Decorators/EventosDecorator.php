<?php

namespace App\Decorators;
use App\Repositories\EventosRepositorie;
use App\Category;
use App\Helpers\Helper;
use App\Instructor;
use App\Evento;
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
		$categorias  	= Category::where('status', 1)->get();
		$instructors 	= Instructor::where('status', 1)->get();
        $id 		 	= $this->helper::base64_decode_url($id);
       	$evento 		= Evento::with(['category', 'instructor'])->findOrFail($id);
       	$myInstructors 	= collect($evento->instructor)->pluck('id')->toArray();
       	$myCategories 	= collect($evento->category)->pluck('id')->toArray();
       	$helper 		= $this->helper;


       	return array("categorias" => $categorias,
       				 "id" => $id,
       				 "instructors" => $instructors,
       				 "evento" => $evento,
       				 "myInstructors" => $myInstructors,
       				 "myCategories" => $myCategories,
       				 "helper" => $helper);
	}


	public function update($request, $id)
	{
		$id = $this->helper::base64_decode_url($id);
		return $this->eventosRepositorie->actualzarEvento($request, $id);
	}

}


