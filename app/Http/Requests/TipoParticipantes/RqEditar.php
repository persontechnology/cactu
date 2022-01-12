<?php

namespace cactu\Http\Requests\TipoParticipantes;

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
            'nombre'=>'required|string|max:191|unique:tipoParticipante,nombre,'.$this->input('modelo'),
        ];
    }
}
