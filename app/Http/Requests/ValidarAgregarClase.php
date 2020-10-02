<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarAgregarClase extends FormRequest
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
            "nombre_clase"          => "required|string|min:4|max:255",
            "img_clase"             => "required|mimes:jpeg,png,jpg",
            "select_instructores"   => "required|array",
            "select_instructores.*" => "required|numeric",
            "select_categorias"     => "required|numeric|max:2",
            "video_bienvenida"    => "required|string|url",
            "descripcion"         => "required|string",
            "select_sesiones"     => "required|numeric",
            "url_zoom"            => "required|array",
            "url_zoom.*"          => "required|string",
            "id_reunion"          => "required|array",
            "id_reunion.*"        => "required|string",
            "codigo_acceso"       => "required|array",
            "codigo_acceso.*"     => "required|string",
            "fecha_inicio"        => "required|array",
            "fecha_inicio.*"      => "required|date",
            "hora_inicio"         => "required|array",
            "hora_inicio.*"       => "required|date_format:H:i"

        ];
    }
}
