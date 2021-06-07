<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarPublicacionAulasMaestro extends FormRequest
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
            "publicaciontxt" => "required|string",
            "titulo"        => "required|string",
            "archivos_aula" => "nullable|array",
        ];
    }


    public function messages()
    {
        return [
            'publicaciontxt.required' => 'El campo es requerido',
            'titulo.required' => 'El campo es requerido',
        ];
    }
}
