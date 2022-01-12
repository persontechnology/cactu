<?php

namespace cactu\Imports;

use cactu\Models\Modulo;
use Maatwebsite\Excel\Concerns\ToModel;
use cactu\Models\ModeloProgramatico;
use Illuminate\Support\Facades\Auth;

class ModuloImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $modelo=ModeloProgramatico::where('nombre',$row[0])->first();
        if($modelo){
            $codigoNombre=explode('-',$row[1]);
            $modulo=Modulo::where('modeloProgramatico_id',$modelo->id)
            ->where('nombre',$codigoNombre[1])->first();
            if(!$modulo){
                $modulo= new Modulo();
                $modulo->nombre=$codigoNombre[1];
                $modulo->codigo=$codigoNombre[0];
                $modulo->modeloProgramatico_id=$modelo->id;
                $modulo->usuarioCreado=Auth::id();
                $modulo->save();
            }
        }
        return $modelo;
    }
}
