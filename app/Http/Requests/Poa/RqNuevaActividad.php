<?php

namespace cactu\Http\Requests\Poa;

use Illuminate\Foundation\Http\FormRequest;

class RqNuevaActividad extends FormRequest
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
            'planificacionModelo' => 'required|exists:planificacionModelo,id',
            'actividad' => 'required|exists:actividad,id',
            'modulo'=>'required|exists:modulo,id',
            'numeroSesion'=>'required|integer|min:0',
            'descripcion'=>'required|max:255'
        ];
    }
}
