<?php

namespace cactu\Http\Requests\Localidad\Comunidad;

use Illuminate\Foundation\Http\FormRequest;

class RqGuardar extends FormRequest
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
            'canton'=>'required|exists:canton,id',
            'nombre' => 'required|unique:comunidad,nombre,NULL,id,canton_id,' . $this->input('canton'),
            'codigo'=>'required|unique:comunidad,codigo,NULL,id,canton_id,' . $this->input('canton'),
            'gestor'=>'required|exists:users,id'
        ];
    }
}
