<?php

namespace App\Repositories;
use App\Course;
use App\CourseInstructor;
use DB;

//HELPERS
use App\Helpers\Helper;

class CoursesRepositorie
{
    protected $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

	public function AgregarCursoRepo($request)
	{
		DB::beginTransaction();

		$course 					      = new Course();
		$course->nombre 				  = $request->nombre_curso;
		$course->video_bienvenida 	      = $request->video_bienvenida;
		$course->descripcion_bienvenida   = $request->descripcion;

		if ($course->save()) {
            //TEMARIO DEL CURSO
            $course->slug           = $this->helper->createSlug($request->nombre_curso, $course->id, "maptv");
            $course->temario        = $this->jsonConverteTemarioCurso($request, $course->id);
			//SUBIR IMAGEN DEL CURSO
			$rootImg = $request->file('img_curso')->store('public/cursos/'.$course->id.'/img_principal/');
            $course->url_img = $rootImg;

            if ($course->save()) {

                if (!$this->insertInstructor($course->id, $request->select_instructores)) {
                    DB::rollback();
                    return back()->withInput()->with("status.newCurso", "error");
                }

                if (!$this->insertCategories($course->id, $request->select_categorias)) {
                    DB::rollback();
                    return back()->withInput()->with("status.newCurso", "error");
                }
            	
                if (!$request->has("curso_extra")) {
                    if (!$this->insertCareers($course->id, $request->select_carreras)) {
                        DB::rollback();
                        return back()->withInput()->with("status.newCurso", "error");
                    }
                }
            	
            	DB::commit();
				return back()->with("status.newCurso", "success");
            }

            DB::rollback();
        	return back()->withInput()->with("status.newCurso", "error");
		}	
	}



	protected function jsonConverteTemarioCurso($request, $course_id)
	{
		//GENERANDO JSON PARA GUARDAR TEMARIO EN BASE DE DATOS
    	$temario_curso = Array();
    	$material_extra = Array();
    	for ($i=0; $i <= count($request->nombre_video) - 1; $i++) { 

    		for ($j=0; $j <= count($request->material_extra[$i]) - 1; $j++) { 
    			$rootMaterial = $request->file('material_extra')[$i][$j]->store('public/cursos/'.$course_id.'/material_extra/'.$i.'/');
    			$material_extra[$i][$i] = $rootMaterial;
    		}

    		$temario_curso[$i] = array("nombre_video" => $request->nombre_video[$i], 
    									"url_video" => $request->video_url[$i], 
    									"descripcion_curso" => $request->descripcion_curso[$i],
    									"material_extra" => $material_extra);
    	}
    	return json_encode($temario_curso);
	}

    protected function insertCategories($course_id, $categories)
    {
        foreach ($categories as $category) {
            $insertCategory = DB::table('courses_categories')->insert(
                ["course_id" => $course_id,
                "category_id" => $category]
            );

            if (!$insertCategory) {
                return false;
            }
        }

        if (!$insertCategory) {
            return false;
        }

        return true;
    }


    protected function insertCareers($course_id, $careers)
    {
        foreach ($careers as $career) {
            $insertCareer = DB::table('courses_careers')->insert(
                ["course_id" => $course_id,
                "career_id" => $career]
            );

            if (!$insertCareer) {
                return false;
            }
        }

        if (!$insertCareer) {
            return false;
        }

        return true;
    } 

    protected function insertInstructor($course_id, $instructors)
    {
        foreach ($instructors as $instructor) {
            $insertInstruct = DB::table('courses_instructors')->insert(
                ["course_id" => $course_id,
                "instructor_id" => $instructor]
            );

            if (!$insertInstruct) {
                return false;
            }
        }

        if (!$insertInstruct) {
            return false;
        }

        return true;
    }
}