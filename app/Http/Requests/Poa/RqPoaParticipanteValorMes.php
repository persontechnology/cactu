<?php

namespace cactu\Http\Requests\Poa;

use Illuminate\Foundation\Http\FormRequest;

class RqPoaParticipanteValorMes extends FormRequest
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
            "poaPartMes"    => "nullable|array",
            "poaPartMes.*"  => "nullable|exists:poaParticipanteMes,id",
            "valores"    => "nullable|array",
            "valores.*"  => "required|integer|min:0",
            "poa"=>'required|exists:poa,id'
        ];
    }
}
