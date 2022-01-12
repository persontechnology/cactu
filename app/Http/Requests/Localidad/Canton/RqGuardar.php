<?php

namespace cactu\Http\Requests\Localidad\Canton;

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
            'provincia'=>'required|exists:provincia,id',
            'nombre' => 'required|unique:canton,nombre,NULL,id,provincia_id,' . $this->input('provincia'),
            'codigo'=>'required|unique:canton,codigo,NULL,id,provincia_id,' . $this->input('provincia'),
        ];
    }
}
