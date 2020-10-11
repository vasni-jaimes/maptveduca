<?php

namespace App\Decorators;
use App\Repositories\ClasesRepositorie;
use App\Category;
use App\Helpers\Helper;
use App\Instructor;
use App\Clase;
use Illuminate\Support\Collection;
use DB;


Class ClasesDecorator
{
	protected $clasesRepositorie;
	protected $helper;

	public function __construct(ClasesRepositorie $clasesRepositorie, Helper $helper)
	{
		$this->clasesRepositorie = $clasesRepositorie;
		$this->helper            = $helper;
	}


	public function store($request)
	{
		return $this->clasesRepositorie->agregarClaseStore($request);
	}

	public function edit($id)
	{
		$id 			= $this->helper::base64_decode_url($id);
		$clase 			= Clase::with(["instructor"])->findOrFail($id);
		$categorias     = Category::where('status', 1)->get();
        $instructores   = Instructor::where('status', 1)->get();
        $myInstructores = collect($clase->instructor)->pluck('id')->toArray();
        $helper 		= $this->helper;
        $sesiones 		= DB::table("clases_sessiones")->where("clas_id", $id)->get();

		$data = array( "id" => $id, 
						"clase" => $clase, 
						"categorias" => $categorias, 
						"instructores" => $instructores,
						"myInstructores" => $myInstructores,
						"sesiones" => $sesiones,
						"helper" => $helper );

		return $data;
	}


	public function update($request, $id)
	{
		$id = $this->helper::base64_decode_url($id);
		return $this->clasesRepositorie->actualizarClase($request, $id);
	}
}


