<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarUpdateEvento extends FormRequest
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
            "img_evento"             => "nullable|mimes:jpeg,png,jpg",
            "select_instructores"   => "required|array",
            "select_instructores.*" => "required|numeric",
            "select_tipo"           => "required|numeric",
            "video_bienvenida"      => "required|string|url",
            "descripcion"           => "required|string",
            "fecha_inicio"          => "required|date",
            "hora_inicio"           => "required|date_format:H:i"
        ];
    }
}
