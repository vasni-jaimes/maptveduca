<?php 


namespace App\Helpers;
use Carbon\Carbon;
use App\TextoAlternativo;
use App\User;
use App\Grupo;
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
        $name = Helper::coding($string);
        $str = strtolower($name);
        $slug = preg_replace('/\s+/', '-', $str);
        return "{$entity}-".self::base64_encode_url($id)."-{$slug}";
    }

    public static function coding($string)
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


    public function contarAlumnos($grupo_id)
    {
        return User::where('grupo_id', $grupo_id)->count();
    }

    public function istrimestre($grupo_id)
    {
        if ($grupo_id == null) {
            return false;    
        }

        //FECHA DE HOY
        date_default_timezone_set('America/Mexico_City');
        $hoy = Carbon::now()->format('Y-m-d');
        //FECHA DE HOY\

        $grupo  = Grupo::where('id', $grupo_id)->first();
        $fechas = DB::table('ciclos_fechas')
                    ->where('ciclo_id', $grupo->ciclo_id)
                    ->where('fecha_inicio', '<=',$hoy)
                    ->where('fecha_final', '>=', $hoy)
                    ->first();
        
        if ($fechas  == null) {
            $fechaParse = Carbon::parse($hoy);

            $fechas = DB::table('ciclos_fechas')
                    ->where('ciclo_id', $grupo->ciclo_id)
                    ->whereMonth('fecha_final', $fechaParse->month)
                    ->whereYear('fecha_final', $fechaParse->year)
                    ->first();
        }

        if (!$fechas) {
            return false;
        }

        return $fechas->trimestre;
    }

    public function fechaFormat($start, $end)
    {
        $meses  = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
        $fecha1  = Carbon::parse($start);
        $mes1    = $meses[($fecha1->format('n')) - 1];

        $fecha2  = Carbon::parse($end);
        $mes2    = $meses[($fecha2->format('n')) - 1];

        return $mes1." - ".$mes2." ".$fecha1->format('Y');
    }


    


    /*public function contarTextoAltern($materias)
    {
        $status = false;
        foreach ($materias as $materia) {
            if ( $this->obtenerTextoAlternativo($materia->cursos->id) ) {
                $status = true;
            }
        }

        return $status;
    }*/


    public function formatoFechaStatus($fecha)
    {
        $meses  = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $fecha1  = Carbon::parse($fecha);
        $mes1    = $meses[($fecha1->format('n')) - 1];


        return $mes1." ".$fecha1->format('Y');
    }


    public function getFechaEspanol($fecha)
    {
        $meses   = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha1  = Carbon::parse($fecha);
        $mes     = $meses[($fecha1->format('n')) - 1];

        return date("d", strtotime($fecha1)). " de ". $mes;
    }

}