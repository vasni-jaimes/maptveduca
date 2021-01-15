<?php 


namespace App\Helpers;
use DB;

class Helper
{
	public static function base64_encode_url($id) {
		return str_replace(['+','/','='], ['-','_',''], base64_encode($id));
	}

	public static function base64_decode_url($id) {
	    return base64_decode(str_replace(['-','_'], ['+','/'], $id));
	}

	public static function createSlug($string, $id, $entity)
    {
        $name = Helper::hola($string);
        $str = strtolower($name);
        $slug = preg_replace('/\s+/', '-', $str);
        return "{$entity}-".self::base64_encode_url($id)."-{$slug}";
    }

    public static function hola($string)
    {
    	setlocale(LC_ALL, 'en_US.UTF8');
		$var = preg_replace("/[^A-Za-z0-9 ]/", '',iconv('UTF-8', 'ASCII//TRANSLIT', $string));
		return $var;
    }

    public function todasImagenesCurso($cursos_id, $categoria, $indice)
    {
        $directory= base_path()."/storage/app/public/cursos/".$cursos_id."/".$categoria."/".$indice;
        if (is_dir($directory)) {
            $dirint = dir($directory);
            $todas = Array();
            while (($archivo = $dirint->read()) !== false)
            {
                if (preg_match("{gif}", $archivo) || preg_match("{jpeg}", $archivo) || preg_match("{zip}", $archivo) || 
                    preg_match("{png}", $archivo) || preg_match("{jpg}", $archivo) || preg_match("{rar}", $archivo) || 
                    preg_match("{webp}", $archivo) || preg_match("{pdf}", $archivo) || preg_match("{doc}", $archivo) ){
                    $todas[] = $cursos_id."/".$categoria."/".$indice."/".$archivo;
                }
            }
            $dirint->close();
            return $todas;
        }

        return false;
    }


    public function contarAlumnos($curso_id)
    {
        return DB::table('tablero_cursos')->where('curso_id', $curso_id)->count();
    }


    public function istrimestre($user_id)
    {
        $trimestre = DB::table('usuarios_membresia')->where('user_id', $user_id)->count();
        if ($trimestre <= 3) 
            return 1;
        elseif ($trimestre > 3 && $trimestre <= 6)
            return 2;
        elseif ($trimestre > 6 && $trimestre <= 9)
            return 3;
        elseif ($trimestre > 9 && $trimestre <= 12)
            return 4;
        elseif ($trimestre > 12 && $trimestre <= 15) 
            return 5;
        elseif ($trimestre > 15 && $trimestre <= 18)
            return 6;
        elseif ($trimestre > 18 && $trimestre <= 21)
            return 7;
        elseif ($trimestre > 21 && $trimestre <= 24)
            return 8;
            
    }
}