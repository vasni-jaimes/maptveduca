<?php

namespace App\Repositories;
use App\Clase;
use DB;

//HELPERS
use App\Helpers\Helper;

class ClasesRepositorie
{
	protected $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }


    public function agregarClaseStore($request)
    {
    	DB::beginTransaction();
    	$clase = new Clase();
    	$clase->nombre_clase 			= $request->nombre_clase;
    	$clase->video_bienvenida 		= $request->video_bienvenida;
    	$clase->descripcion_bienvenida 	= $request->descripcion;
    	$clase->cuantas_sesiones 		= $request->select_sesiones;

    	if ($clase->save()) {
    		//SLUG DE LA CLASE
            $clase->slug           = $this->helper->createSlug($request->nombre_clase, $clase->id, "maptvc");
			//SUBIR IMAGEN DEL CURSO
			$rootImg = $request->file('img_clase')->store('public/clases/'.$clase->id.'/img_principal/');
            $clase->img = $rootImg;

            if ($clase->save()) {

            	if (!$this->insertInstructor($clase->id, $request->select_instructores)) {
                    DB::rollback();
                    return back()->withInput()->with("status.newClass", "error");
                }

                if (!$this->insertCategories($clase->id, $request->select_categorias)) {
                    DB::rollback();
                    return back()->withInput()->with("status.newClass", "error");
                }

                if (!$this->insertSessiones($clase->id, $request)) {
                	DB::rollback();
                    return back()->withInput()->with("status.newClass", "error");
                }

                DB::commit();
				return back()->with("status.newClass", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.newClass", "error");
    	}

    	DB::rollback();
        return back()->withInput()->with("status.newClass", "error");
    }


    public function actualizarClase($request, $id)
    {
        DB::beginTransaction();
        $clase                          = Clase::findOrFail($id);
        $clase->nombre_clase            = $request->nombre_clase;
        $clase->video_bienvenida        = $request->video_bienvenida;
        $clase->descripcion_bienvenida  = $request->descripcion;
        $clase->cuantas_sesiones        = $request->select_sesiones;

        if ($clase->save()) {
            //TEMARIO DEL CURSO
            $clase->slug            = $this->helper->createSlug($request->nombre_clase, $clase->id, "maptvc");

            //SUBIR IMAGEN DE LA CLASE
            if ( $request->hasFile('img_clase') ) {
                $this->eliminarImagen($request->img_clase);
                $rootImg = $request->file('img_clase')->store('public/clases/'.$clase->id.'/img_principal/');
                $clase->img = $rootImg;
            }

            if ($clase->save()) {

                /* ACTUALIZAR INSTRUCTOR */
                if (!$this->eliminarInstructor($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_clase);
                    return back()->withInput()->with("status.updateClass", "error");
                }

                if (!$this->insertInstructor($clase->id, $request->select_instructores)) {
                    DB::rollback();
                    return back()->withInput()->with("status.updateClass", "error");
                }
                /* ACTUALIZAR INSTRUCTOR \\ */


                /* ACTUALIZAR CATEGORIAS */
                if (!$this->eliminarCategories($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_clase);
                    return back()->withInput()->with("status.updateClass", "error");
                }

                if (!$this->insertCategories($clase->id, $request->select_categorias)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_clase);
                    return back()->withInput()->with("status.updateClass", "error");
                }
                /* ACTUALIZAR CATEGORIAS \\ */


                /* ACTUALIZAR SESSIONES */
                if (!$this->eliminarSessiones($id)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_clase);
                    return back()->withInput()->with("status.updateClass", "error");
                }

                if (!$this->insertSessiones($clase->id, $request)) {
                    DB::rollback();
                    $this->eliminarImagen($request->img_clase);
                    return back()->withInput()->with("status.updateClass", "error");
                }
                /* ACTUALIZAR SESSIONES \\  */

                DB::commit();
                return back()->with("status.updateClass", "success");
            }

            DB::rollback();
            return back()->withInput()->with("status.updateClass", "error");
        }

        DB::rollback();
        return back()->withInput()->with("status.updateClass", "error");
    }


    protected function insertSessiones($clas_id, $request)
    {
    	for ($i = 0; $i <= count($request->url_zoom) - 1; $i++) {
    		$insertClass = DB::table('clases_sessiones')->insert(
                [
                	"clas_id" => $clas_id,
                	"url_zoom" => $request->url_zoom[$i],
                	"id_reunion" => trim($request->id_reunion[$i]),
                	"codigo_acceso" => trim($request->codigo_acceso[$i]),
                	"fecha_inicio" => $request->fecha_inicio[$i]." ".$request->hora_inicio[$i].":00"
            	]
            );

            if (!$insertClass) {
                return false;
            }
    	}

    	if (!$insertClass) {
            return false;
        }

        return true;
    }


    protected function eliminarSessiones($clas_id)
    {
        $eliminarSessiones = DB::table('clases_sessiones')
                                ->where('clas_id', $clas_id)->delete();

        return true;
    }


    protected function insertCategories($clas_id, $categories)
    {
        foreach ($categories as $category) {
            $insertCategory = DB::table('clases_categories')->insert(
                ["clas_id" => $clas_id,
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


    protected function eliminarCategories($clas_id)
    {
        $eliminarCategory = DB::table('clases_categories')
                                ->where('clas_id', $clas_id)->delete();

        return true;
    }


    protected function insertInstructor($clas_id, $instructors)
    {
        foreach ($instructors as $instructor) {
            $insertInstruct = DB::table('clases_instructors')->insert(
                ["clas_id" => $clas_id,
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


    protected function eliminarInstructor($clas_id)
    {
        $eliminarInstructor = DB::table('clases_instructors')
                                ->where('clas_id', $clas_id)->delete();

        return true;
    }

    protected function eliminarImagen($file)
    {
        return \Storage::delete($file);
    }
}