<?php

namespace App\Decorators;
use App\Repositories\InstructoresRepositorie;
use App\Category;
use App\Helpers\Helper;
use Illuminate\Support\Collection;


Class InstructoresDecorator
{

	protected $instructorRepositorie;
	protected $helper;

	public function __construct(InstructoresRepositorie $instructorRepositorie, Helper $helper)
	{
		$this->instructorRepositorie = $instructorRepositorie;
		$this->helper            = $helper;
	}


	public function store($request)
	{
		return $this->instructorRepositorie->agregarInstructor($request);
	}

	public function update($request, $id)
	{
		$id = $this->helper::base64_decode_url($id);
		return $this->instructorRepositorie->actualizarInstructor($request, $id);
	}

}