<?php

namespace cactu\Http\Requests\Localidad\Comunidad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use cactu\Models\Localidad\Comunidad;

class RqActualizar extends FormRequest
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
            'comunidad'=>'required|exists:comunidad,id',
            'nombre'=> Rule::unique('comunidad')->where(function ($query) {
                $comunidad=Comunidad::findOrFail($this->input('comunidad'));
                return $query->where('canton_id',$comunidad->canton->id)->where('id','!=',$this->input('comunidad'));
            }),
            'codigo'=> Rule::unique('comunidad')->where(function ($query) {
                $comunidad=Comunidad::findOrFail($this->input('comunidad'));
                return $query->where('canton_id',$comunidad->canton->id)->where('id','!=',$this->input('comunidad'));
            }),
            'canton'=>'required|exists:canton,id',
            'gestor'=>'required|exists:users,id'
        ];
    }
}
