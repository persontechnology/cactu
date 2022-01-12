<?php

namespace cactu\Http\Requests\Planificaciones;

use Illuminate\Foundation\Http\FormRequest;

class RqCrear extends FormRequest
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
            'nombre'=>'required|string|max:255',           
            'desde'=>'required|date',
            'hasta'=>'required|date',
        ];
    }
}
