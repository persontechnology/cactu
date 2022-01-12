<?php

namespace cactu\Http\Requests\Poa;

use Illuminate\Foundation\Http\FormRequest;

class RqPoaCuentaContableValorMes extends FormRequest
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
            "poaContMes"    => "nullable|array",
            "poaContMes.*"  => "nullable|exists:poaCuentaContableMes,id",
            "valores"    => "nullable|array",
            "valores.*"  => "required|regex:/^\d+(\.\d{1,2})?$/",
            "cuentaContable"=>'required|exists:cuentaContablePoaCuenta,id'
        ];
    }
}
