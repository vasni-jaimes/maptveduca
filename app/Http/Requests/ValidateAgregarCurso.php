<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAgregarCurso extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nombre_curso"           => "required|string|min:4|max:255",
            "img_curso"              => "required|mimes:jpeg,png,jpg",
            "select_instructores"    => "required|array",
            "select_instructores.*"  => "required|numeric",
            "curso_extra"            => "nullable|numeric",
            "select_carreras"        => "required_without:curso_extra|array",
            "select_carreras.*"      => "required_without:curso_extra|numeric",
            "select_categorias"      => "required|numeric",
            "select_subcategorias"   => "required|array",
            "select_subcategorias.*" => "required|numeric",
            "video_bienvenida"       => "required|string|url",
            "descripcion"            => "required|string",
            "nombre_video"           => "required|array",
            "nombre_video.*"         => "required|string",
            "video_url"              => "required|array",
            "video_url.*"            => "required|array",
            "video_url.*.*"          => "required|string",
            "descripcion_curso"      => "required|array",
            "descripcion_curso.*"    => "required|string",
            "material_extra"         => "nullable|array",
        ];
    }
}
