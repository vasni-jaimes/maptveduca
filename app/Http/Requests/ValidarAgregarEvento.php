<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class ValidarAgregarEvento extends FormRequest
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
            
            "nombre_evento"          => "required|string|min:4|max:255",
            "img_evento"             => "required|mimes:jpeg,png,jpg",
            "select_instructores"   => "required|array",
            "select_instructores.*" => "required|numeric",
            "select_tipo"           => "required|numeric",
            "video_bienvenida"      => "required|string|url",
            "descripcion"           => "required|string",
            "url_zoom"              => new RequiredIf($this->select_tipo == 1),
            "id_reunion"            => new RequiredIf($this->select_tipo == 1),
            "codigo_acceso"         => new RequiredIf($this->select_tipo == 1),
            "url_video"             => new RequiredIf($this->select_tipo == 2),
            "fecha_inicio"          => "required|date",
            "hora_inicio"           => "required|date_format:H:i"
        ];
    }
}
