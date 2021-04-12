<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Helper;

class ValidarEditarInstructor extends FormRequest
{

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }
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

        //dd(request('instructor_id'));

        return [
            "nombre_instructor"     => "required|string|min:4|max:255",
            "apellido_instructor"   => "required|string|min:4|max:255",
            "email"                 => "required|string|min:4|max:255|email|unique:instructors,email,".$this->helper::base64_decode_url(request('instructor_id')).",id",
            "especialidad"          => "required|string|min:4|max:255",
            "bibliografia"          => "required|string|min:6",
            "password"              => "nullable|string|min:8",
            "avatar"                => "nullable|mimes:jpeg,png,jpg",
        ];
    }
}
