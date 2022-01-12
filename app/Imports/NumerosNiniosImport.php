<?php

namespace cactu\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

use cactu\Models\Ninio;
use cactu\Models\Localidad\Comunidad;
use cactu\Models\TipoParticipante;
use cactu\Models\Familia;
use Carbon\Carbon;
class NumerosNiniosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $modelo=Ninio::where('numeroChild',$row[0])->first();
        if($modelo){
            $modelo->celular=$row[6];
            // $modelo->email=$row[7];          
            $modelo->save();
            
           if($modelo->familia){           
                $familia=$modelo->familia;
                $familia->papa=$row[1];
                $familia->mama=$row[2];
                $familia->otro1=$row[3];
                $familia->otro2=$row[4];
                $familia->otro3=$row[5];
                $familia->save();
                }else{
                    $familia=new Familia();
                    $familia->ninio_id=$modelo->id;
                    $familia->papa=$row[1];
                    $familia->mama=$row[2];
                    $familia->otro1=$row[3];
                    $familia->otro2=$row[4];
                    $familia->otro3=$row[5];
                    $familia->save();
                }
        }
        return $modelo;
    }
 
}
