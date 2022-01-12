<?php

namespace cactu\Http\Requests\Actividades;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use cactu\Models\Actividad;
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
            $actividad=Actividad::findOrFail($this->input('actividad'));  
            $modelo=ModeloProgramatico::findOrFail($actividad->modeloProgramatico_id);      
            $validateNombre=Actividad::where('nombre',$this->input('nombre'))
            ->where('id','!=',$actividad->id) 
            ->where('modeloProgramatico_id',$modelo->id)          
            ->count();
            if($validateNombre==0){
                return true;
            }else{
                return false;
            }

        },"El nombre de la actividad ya esta asignada a este modelo");

        Validator::extend('existeCodigo', function($attribute, $value, $parameters){
            $actividad=Actividad::findOrFail($this->input('actividad'));  
            $modelo=ModeloProgramatico::findOrFail($actividad->modeloProgramatico_id);      
            $validateActividad=Actividad::where('codigo',$this->input('codigo'))
            ->where('id','!=',$actividad->id) 
            ->where('modeloProgramatico_id',$modelo->id)          
            ->count();
            if($validateActividad==0){
                return true;
            }else{
                return false;
            }

        },"El código de la actividad ya esta asignada a este modelo");
        return [
            'actividad'=>'required',
            'nombre'=>'required|string|max:191|existeNombre',
            'codigo'=>'required|string|max:191|existeCodigo',
        ];
    }
}
