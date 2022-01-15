<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarFechasCicloEscolar extends FormRequest
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
            "nombre_ciclo" => "required",
            "fecha_inicio-1" => "required|date",
            "fecha_final-1" => "required|date",
            "fecha_inicio-2" => "required|date",
            "fecha_final-2" => "required|date",
            "fecha_inicio-3" => "required|date",
            "fecha_final-3" => "required|date",
            "fecha_inicio-4" => "required|date",
            "fecha_final-4" => "required|date",
            "fecha_inicio-5" => "required|date",
            "fecha_final-5" => "required|date",
            "fecha_inicio-6" => "required|date",
            "fecha_final-6" => "required|date",
            "fecha_inicio-7" => "required|date",
            "fecha_final-7" => "required|date",
            "fecha_inicio-8" => "required|date",
            "fecha_final-8" => "required|date",
        ];
    }
}
