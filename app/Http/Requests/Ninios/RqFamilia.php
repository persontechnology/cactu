<?php

namespace cactu\Http\Requests\Ninios;

use Illuminate\Foundation\Http\FormRequest;

class RqFamilia extends FormRequest
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
            'papa'=>'nullable|string|max:255',
            'mama'=>'nullable|string|max:255',
            'otro1'=>'required|string|max:255',
            'otro2' => 'nullable|string',
            'otro3'=>'nullable|email|max:255',
        ];
    }
    public function messages()
    {
        return [
            'otro1.required'=>'El campo representante es obligatorio',
            'otro1.max'=>'El campo representante no debe contener más de :max caracteres.',
            'otro2.required'=>'El campo N celular es obligatorio',
            'otro3.required'=>'El campo email es obligatorio',
            'otro3.email'=>'El campo email es incorrecto',
        ];
    }
}
