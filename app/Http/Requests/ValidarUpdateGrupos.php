<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarUpdateGrupos extends FormRequest
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
            "nombre_grupo" => "required|string|min:2|max:255|unique:grupos,nombre,".request('grupo_id').",slug",
        ];
    }
}
