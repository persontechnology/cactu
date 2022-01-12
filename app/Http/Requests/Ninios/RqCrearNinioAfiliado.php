<?php

namespace cactu\Http\Requests\Ninios;

use Illuminate\Foundation\Http\FormRequest;

class RqCrearNinioAfiliado extends FormRequest
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
        $reg='';
        if($this->input('numeroChild')){
            $reg='required|integer|unique:ninio,numeroChild';
            
        }
        return [
            'nombres'=>'string|max:255|unique:ninio,nombres',
            'email' => 'string|email|max:255|unique:ninio,email',
            'numeroChild'=>$reg,
            'nombres'=>'required|string|max:255',
            'genero'=>'required|string|max:255',
            'fechaNacimiento'=>'required',
            'fechaRegistro'=>'required',
        ];  
    }
}
