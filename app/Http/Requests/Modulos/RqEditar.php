<?php

namespace cactu\Http\Requests\Modulos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use cactu\Models\Modulo;
use cactu\Models\ModeloProgramatico;

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
        Validator::extend('existeNombre', function($attribute, $value, $parameters){
            $modulo=Modulo::findOrFail($this->input('modulo'));  
            $modelo=ModeloProgramatico::findOrFail($modulo->modeloProgramatico_id);      
            $validateNombre=Modulo::where('nombre',$this->input('nombre'))
            ->where('id','!=',$modulo->id) 
            ->where('modeloProgramatico_id',$modelo->id)          
            ->count();
            if($validateNombre==0){
                return true;
            }else{
                return false;
            }

        },"El nombre del módulo ya esta asignada a este modelo");

        Validator::extend('existeCodigo', function($attribute, $value, $parameters){
            $modulo=Modulo::findOrFail($this->input('modulo'));  
            $modelo=ModeloProgramatico::findOrFail($modulo->modeloProgramatico_id);      
            $validateModulo=Modulo::where('codigo',$this->input('codigo'))
            ->where('id','!=',$modulo->id) 
            ->where('modeloProgramatico_id',$modelo->id)          
            ->count();
            if($validateModulo==0){
                return true;
            }else{
                return false;
            }

        },"El código del módulo ya esta asignada a este modelo");
        return [
            'modulo'=>'required',
            'nombre'=>'required|string|max:191|existeNombre',
            'codigo'=>'required|string|max:191|existeCodigo',
        ];
    }
}
