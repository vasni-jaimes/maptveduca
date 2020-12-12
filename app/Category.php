<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Course;
use DB;

class Category extends Model
{
    protected $table = 'categories';


    public function cursos()
    {
    	return $this->hasMany('App\Course', 'categoria_id');
    }

    public function subcategorias()
    {
    	return $this->hasMany('App\Subcategoria', 'categoria_id');
    }


    public function ObtenerCursos($subcategoria_id)
    {	
 		$cursos = DB::table("courses_subcategorias")
 					->select("course_id")
 					->where("subcategoria_id", $subcategoria_id)->get();

 		$cursos = collect($cursos)->pluck('course_id')->toArray();
 		return Course::whereIn('id', $cursos)->where('status', 1)->get();
    }


    public function obtenerConteoCat($categoria_id)
    {
        return Course::where("categoria_id", $categoria_id)->where("status", 1)->count();
    }

    public function quitarAcentos($cadena)
    {
        $cadBuscar  = array("á", "Á", "é", "É", "í", "Í", "ó", "Ó", "ú", "Ú", " ");
        $cadPoner   = array("a", "A", "e", "E", "i", "I", "o", "O", "u", "U", "");
        $cadena     = str_replace ($cadBuscar, $cadPoner, $cadena);
        return strtolower($cadena);
    }
}
