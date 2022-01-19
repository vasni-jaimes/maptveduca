<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Helper;

class ValidarUpdateAdministrador extends FormRequest
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
        return [
            "nombres"       => "required|string|min:4|max:255",
            "apellidos"     => "required|string|min:4|max:255",
            "email"         => "required|string|min:4|max:255|email|unique:administrators,email,".$this->helper::base64_decode_url(request('admin_id')).",id",
            "select_roles"  => "required|numeric",
            "password"      => "nullable|string|min:8|confirmed",
        ];
    }
}
