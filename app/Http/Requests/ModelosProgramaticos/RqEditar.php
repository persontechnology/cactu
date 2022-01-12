<?php

namespace cactu\Http\Requests\ModelosProgramaticos;

use Illuminate\Foundation\Http\FormRequest;

class RqEditar extends FormRequest
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
            'nombre'=>'required|string|max:191|unique:modeloProgramatico,nombre,'.$this->input('modelo'),
            'codigo'=>'required|string|max:191|unique:modeloProgramatico,codigo,'.$this->input('modelo'),
        ];
    }
}
