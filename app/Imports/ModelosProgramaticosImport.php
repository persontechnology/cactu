<?php

namespace cactu\Imports;

use cactu\Models\ModeloProgramatico;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
class ModelosProgramaticosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $modelo=ModeloProgramatico::where('nombre',$row[0])->first();
        if (!$modelo) {
            $modeloProgra=new ModeloProgramatico();
            $modeloProgra->nombre=$row[0];
            $modeloProgra->codigo=$row[1];
            $modeloProgra->usuarioCreado=Auth::id();
            $modeloProgra->save();
        }
        return  $modelo;
    }
}
