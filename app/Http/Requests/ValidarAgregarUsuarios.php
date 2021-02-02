<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarAgregarUsuarios extends FormRequest
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
            "nombre"            => "required|string|min:4|max:255",
            "amaterno"          => "required|string|min:4|max:255",
            "apaterno"          => "required|string|min:4|max:255",
            "email"             => "required|string|min:4|max:255|email|unique:users",
            "fecha_nacimineto"  => "required|date",
            "suscripcion"       => "nullable|numeric",
            "select_carreras"   => "required_without:suscripcion|numeric",
            "password"          => "required|string|min:8|confirmed",
        ];
    }
}
