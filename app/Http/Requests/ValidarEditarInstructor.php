<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarEditarInstructor extends FormRequest
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
            "nombre_instructor"     => "required|string|min:4|max:255",
            "apellido_instructor"   => "required|string|min:4|max:255",
            "email"                 => "required|string|min:4|max:255|email|unique:instructors",
            "especialidad"          => "required|string|min:4|max:255",
            "bibliografia"          => "required|string|min:6",
            "avatar"                => "nullable|mimes:jpeg,png,jpg",
        ];
    }
}
