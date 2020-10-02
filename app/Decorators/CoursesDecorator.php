<?php


namespace App\Decorators;
use App\Repositories\CoursesRepositorie;
use App\Subcategoria;
use App\Helpers\Helper;
use App\Course;
use App\Instructor;
use App\Career;
use App\Category;
use Illuminate\Support\Collection;

Class CoursesDecorator
{
	protected $coursesRepositorie;
	public function __construct(CoursesRepositorie $coursesRepositorie, Helper $helper)
	{
		$this->coursesRepositorie = $coursesRepositorie;
		$this->helper             = $helper;
	}

	public function AgregarCursoDecore($request)
	{
		return $this->coursesRepositorie->AgregarCursoRepo($request);
	}

	public function edit($id)
	{
		$categorias  		= Category::where('status', 1)->get();
		$instructors 		= Instructor::where('status', 1)->get();
		$careers 			= Career::where('status', 1)->get();
        $id 		 		= $this->helper::base64_decode_url($id);
       	$curso 		 		= Course::with(['subcategorias', 'careers', 'instructor'])->findOrFail($id);
       	$subcategorias 		= Subcategoria::where("status", 1)->where("categoria_id", $curso->categoria_id)->get();


       	$myInstructors 		= collect($curso->instructor)->pluck('id')->toArray();
       	$myCareers			= collect($curso->careers)->pluck('id')->toArray();
       	$mySubcategorias 	= collect($curso->subcategorias)->pluck('id')->toArray();
       	$temario 			= json_decode($curso->temario);
       	$helper 			= $this->helper;


       	return array("subcategorias" => $subcategorias,
       				 "categorias" => $categorias,
       				 "id" => $id,
       				 "instructors" => $instructors,
       				 "curso" => $curso,
       				 "careers" => $careers, 
       				 "myInstructors" => $myInstructors,
       				 "mySubcategorias" => $mySubcategorias,
       				 "temario" => $temario,
       				 "helper" => $helper,
       				 "myCareers" => $myCareers);
	}


	public function update($request, $id)
	{
		return $this->coursesRepositorie->update($request, $id);
	}
}