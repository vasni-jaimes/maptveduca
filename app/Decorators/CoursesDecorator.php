<?php


namespace App\Decorators;
use App\Repositories\CoursesRepositorie;
//use Illuminate\Support\Collection;

Class CoursesDecorator
{
	protected $coursesRepositorie;
	public function __construct(CoursesRepositorie $coursesRepositorie)
	{
		$this->coursesRepositorie = $coursesRepositorie;
	}

	public function AgregarCursoDecore($request)
	{
		return $this->coursesRepositorie->AgregarCursoRepo($request);
	}
}