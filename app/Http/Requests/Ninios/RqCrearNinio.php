<?php

namespace cactu\Http\Requests\Ninios;

use Illuminate\Foundation\Http\FormRequest;

class RqCrearNinio extends FormRequest
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
        'comunidad'=>'required',
       
        'nombres'=>'required|string|max:255|unique:ninio,nombres',
        'genero'=>'required',
        'fechaNacimiento'=>'required',
        'fechaRegistro'=>'required',

        ];
    }
}
