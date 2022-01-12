<?php

namespace cactu\Imports;

use cactu\Models\Actividad;
use Maatwebsite\Excel\Concerns\ToModel;
use cactu\Models\ModeloProgramatico;
use Illuminate\Support\Facades\Auth;
class ActividadesImport implements ToModel
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
            $actividad=Actividad::where('modeloProgramatico_id',$modelo->id)
            ->where('nombre',$row[1])->first();
            if(!$actividad){
                $actividad= new Actividad();
                $actividad->nombre=$row[1];
                $actividad->codigo=substr($row[2],2,10);
                $actividad->modeloProgramatico_id=$modelo->id;
                $actividad->usuarioCreado=Auth::id();
                $actividad->save();
            }
        }
        return $modelo;

    }
}
