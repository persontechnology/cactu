<?php

namespace cactu\Http\Requests\Poa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class RqPoaActividadValorMes extends FormRequest
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
            "poaActMes"    => "nullable|array",
            "poaActMes.*"  => "nullable|exists:poaActividadMes,id",
            "valores"    => "nullable|array",
            "valores.*"  => "required|integer|min:0",
            "poa"=>'required|exists:poa,id'
        ];
    }
}
