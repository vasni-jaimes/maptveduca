<?php 


namespace App\Helpers;

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
}