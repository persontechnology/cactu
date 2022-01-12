<?php

namespace cactu\Http\Requests\Localidad\Canton;

use Illuminate\Foundation\Http\FormRequest;
use cactu\Models\Localidad\Canton;
use Illuminate\Validation\Rule;

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
            'canton'=>'required|exists:canton,id',
            'nombre'=> Rule::unique('canton')->where(function ($query) {
                $canton=Canton::findOrFail($this->input('canton'));
                return $query->where('provincia_id',$canton->provincia->id)->where('id','!=',$this->input('canton'));
            }),
            'codigo'=> Rule::unique('canton')->where(function ($query) {
                $canton=Canton::findOrFail($this->input('canton'));
                return $query->where('provincia_id', $canton->provincia->id)->where('id','!=',$this->input('canton'));
            }),
            'provincia'=>'required|exists:provincia,id'
        ];
    }
}
