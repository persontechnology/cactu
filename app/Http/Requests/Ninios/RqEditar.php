<?php

namespace cactu\Http\Requests\Ninios;

use Illuminate\Foundation\Http\FormRequest;
use cactu\Models\TipoParticipante;
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

        $tipoParticipante=TipoParticipante::findOrFail($this->input('tipoParticipante')); 
        if($tipoParticipante->nombre=="INNAJ Inscritos/afiliados"){
          return [
            'tipoParticipante'=>'required',
            'comunidad_id'=>'required',
            'email' => 'nullable|string|email|max:255|unique:ninio,email,'.$this->input('ninio'),
            'numeroChild'=>'integer|unique:ninio,numeroChild,'.$this->input('ninio'),
            'nombres'=>'required|string|max:255',
            'genero'=>'required|string|max:255',
            'fechaNacimiento'=>'required',
            'fechaRegistro'=>'required',
            ];  
        }else{
            return [
            'tipoParticipante'=>'required',
            'comunidad_id'=>'required',
            'nombres'=>'required|string|max:255',
            'genero'=>'required',
            'fechaNacimiento'=>'required',
            'fechaRegistro'=>'required',
            'email' => 'nullable|email|max:255|unique:ninio,email,'.$this->input('ninio'),

            ];
        }
        
    }
}


