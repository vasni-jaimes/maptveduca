<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarContacto extends FormRequest
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
            "nombre" => "required|string|max:100",
            "email" => "required|email|max:100",
            "ciudad" => "required|string|max:100",
            "pais" => "required|string|max:100",
            "mensaje" => "required|string",
        ];
    }
}
