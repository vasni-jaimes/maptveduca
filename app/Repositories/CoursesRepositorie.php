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
        $course->categoria_id             = $request->select_categorias;
        if ($request->has("curso_extra")) {
            $course->extra = 1;
        }
        

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

                if (!$this->insertSubCategories($course->id, $request->select_subcategorias)) {
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


    public function update($request, $id)
    {
        DB::beginTransaction();

        $course                           = Course::findOrFail($id);
        $course->nombre                   = $request->nombre_curso;
        $course->video_bienvenida         = $request->video_bienvenida;
        $course->descripcion_bienvenida   = $request->descripcion;
        $course->categoria_id             = $request->select_categorias;
        if ($request->has("curso_extra")) {
            $course->extra = 1;
        }

        if ($course->save()) {
            //TEMARIO DEL CURSO
            $course->slug           = $this->helper->createSlug($request->nombre_curso, $course->id, "maptv");
            $course->temario        = $this->jsonConverteTemarioCurso($request, $course->id);
            //SUBIR IMAGEN DEL CURSO
            if ( $request->hasFile('img_curso') ) {
                $this->eliminarImagen($request->img_curso);
                $rootImg = $request->file('img_curso')->store('public/cursos/'.$course->id.'/img_principal/');
                $course->url_img = $rootImg;
            }

            if ($course->save()) {

                //ACTUALIZAR INSTRUCTOR
                
                if (!$this->eliminarInstructor($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_curso);
                    return back()->withInput()->with("status.updateCurso", "error");
                }

                if (!$this->insertInstructor($course->id, $request->select_instructores)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_curso);
                    return back()->withInput()->with("status.updateCurso", "error");
                }

                //ACTUALIZAR INSTRUCTOR\\


                //ACTUALIZAR CATEGORIAS
                if (!$this->eliminarSubCategories($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_curso);
                    return back()->withInput()->with("status.updateCurso", "error");
                }

                if (!$this->insertSubCategories($course->id, $request->select_subcategorias)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_curso);
                    return back()->withInput()->with("status.updateCurso", "error");
                }
                //ACTUALIZAR CATEGORIAS\\


                //ACTUALIZAR CARRERAS SI HAY CURSO EXTRA
                if (!$this->eliminarCareers($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_curso);
                    return back()->withInput()->with("status.updateCurso", "error");
                }

                if (!$request->has("curso_extra")) {
                    if (!$this->insertCareers($course->id, $request->select_carreras)) {
                        DB::rollback();
                        $this->eliminarImagen($request->img_curso);
                        return back()->withInput()->with("status.updateCurso", "error");
                    }
                }
                //ACTUALIZAR CARRERAS SI HAY CURSO EXTRA\\
                
                DB::commit();
                return back()->with("status.updateCurso", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.updateCurso", "error");
        }
    }


	protected function jsonConverteTemarioCurso($request, $course_id)
	{
		//GENERANDO JSON PARA GUARDAR TEMARIO EN BASE DE DATOS
    	$temario_curso  = Array();
    	$material_extra = Array();

    	for ($i=0; $i <= count($request->nombre_video) - 1; $i++) { 
            $material_extra = Array();
            if (isset($request->material_extra[$i])) {
            
        		for ($j=0; $j <= count($request->material_extra[$i]) - 1; $j++) { 
                    $request->file('material_extra')[$i][$j]->store('public/cursos/'.$course_id.'/material_extra/'.$i.'/');
        			$rootMaterial = $request->file('material_extra')[$i][$j]->store('public/cursos/'.$course_id.'/material_extra/'.$i.'/');
        			$material_extra[$j] = $rootMaterial;
        		}
            }


    		$temario_curso[$i] = array("nombre_video" => $request->nombre_video[$i], 
                                        "slug" => $this->helper->createSlug($request->nombre_video[$i], $i, "maptv"),
    									"url_video" => $request->video_url[$i], 
                                        "material_extra" => $material_extra,
    									"descripcion_curso" => $request->descripcion_curso[$i] );
    	}

    	return json_encode($temario_curso);
	}


    protected function insertSubCategories($course_id, $subcategories)
    {
        foreach ($subcategories as $category) {
            $insertCategory = DB::table('courses_subcategorias')->insert(
                ["course_id" => $course_id,
                "subcategoria_id" => $category]
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


    protected function eliminarSubCategories($course_id)
    {
        $eliminarCategory = DB::table('courses_subcategorias')
                                ->where('course_id', $course_id)->delete();

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


    protected function eliminarCareers($course_id)
    {
        $eliminarCareers = DB::table('courses_careers')
                                ->where('course_id', $course_id)->delete();


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


    protected function eliminarInstructor($course_id)
    {
        $eliminarInstructor = DB::table('courses_instructors')
                                ->where('course_id', $course_id)->delete();

        return true;
    }

    protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }
}