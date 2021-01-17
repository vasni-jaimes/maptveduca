<?php 


namespace App\Helpers;
use Carbon\Carbon;
use App\TextoAlternativo;
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

    public function obtenerFechaTrimestre()
    {
        $trimestre = DB::table('usuarios_membresia')->where('user_id', auth()->user()->id)->count();
        if ($trimestre == 1 || $trimestre == 4 || $trimestre == 7 || $trimestre == 10 || $trimestre == 13 || $trimestre == 16 || $trimestre == 19 || $trimestre == 22){ 

            $ultimoPago     = auth()->user()->ultimoPago();
            $fehcaInicio    = $ultimoPago->fehca_inicio;
            $start          = Carbon::parse($fehcaInicio);
            $end            = Carbon::parse($fehcaInicio)->addMonths(3);

            return $this->fechaFormat($start, $end);
        }
        elseif ($trimestre == 2 || $trimestre == 5 || $trimestre == 8 || $trimestre == 11 || $trimestre == 14 || $trimestre == 17 || $trimestre == 20 || $trimestre == 23){

            $ultimoPago     = auth()->user()->ultimoPago();
            $fehcaInicio    = $ultimoPago->fehca_inicio;
            $start          = Carbon::parse($fehcaInicio)->subMonths(1);
            $end            = Carbon::parse($fehcaInicio)->addMonths(2);

            return $this->fechaFormat($start, $end);
        }
        elseif ($trimestre == 3 || $trimestre == 6 || $trimestre == 9 || $trimestre == 12 || $trimestre == 15 || $trimestre == 18 || $trimestre == 21 || $trimestre == 24){

            $ultimoPago     = auth()->user()->ultimoPago();
            $fehcaInicio    = $ultimoPago->fehca_inicio;
            $start          = Carbon::parse($fehcaInicio)->subMonths(2);
            $end            = Carbon::parse($fehcaInicio)->addMonths(1);

            return $this->fechaFormat($start, $end);
        } 
    }


    protected function fechaFormat($start, $end)
    {
        $meses  = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
        $fecha1  = Carbon::parse($start);
        $mes1    = $meses[($fecha1->format('n')) - 1];

        $fecha2  = Carbon::parse($end);
        $mes2    = $meses[($fecha2->format('n')) - 1];

        return $mes1." - ".$mes2." ".$fecha1->format('Y');
    }


    public function obtenerTextoAlternativo($curso_id)
    {
        $texto = TextoAlternativo::where('curso_id', $curso_id)->first();
        if ($texto) {
            return $texto->texto;
        }

        return false;
    }


    public function contarTextoAltern($materias)
    {
        $status = false;
        foreach ($materias as $materia) {
            if ( $this->obtenerTextoAlternativo($materia->cursos->id) ) {
                $status = true;
            }
        }

        return $status;
    }
}