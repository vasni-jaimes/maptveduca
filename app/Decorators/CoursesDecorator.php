<?php


namespace App\Decorators;
use App\Repositories\CoursesRepositorie;
use App\Category;
use App\Helpers\Helper;
use App\Course;
use App\Instructor;
use App\Career;
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
		$categorias  	= Category::where('status', 1)->get();
		$instructors 	= Instructor::where('status', 1)->get();
		$careers 		= Career::where('status', 1)->get();
        $id 		 	= $this->helper::base64_decode_url($id);
       	$curso 		 	= Course::with(['category', 'careers', 'instructor'])->findOrFail($id);
       	$myInstructors 	= collect($curso->instructor)->pluck('id')->toArray();
       	$myCareers		= collect($curso->careers)->pluck('id')->toArray();
       	$myCategories 	= collect($curso->category)->pluck('id')->toArray();
       	$temario 		= json_decode($curso->temario);
       	$helper 		= $this->helper;


       	return array("categorias" => $categorias,
       				 "id" => $id,
       				 "instructors" => $instructors,
       				 "curso" => $curso,
       				 "careers" => $careers, 
       				 "myInstructors" => $myInstructors,
       				 "myCategories" => $myCategories,
       				 "temario" => $temario,
       				 "helper" => $helper,
       				 "myCareers" => $myCareers);
	}


	public function update($request, $id)
	{
		return $this->coursesRepositorie->update($request, $id);
	}
}