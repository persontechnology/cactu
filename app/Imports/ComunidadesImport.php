<?php

namespace cactu\Imports;

use cactu\Models\Localidad\Comunidad;
use Maatwebsite\Excel\Concerns\ToModel;
use cactu\Models\Localidad\Canton;
use cactu\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ComunidadesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $comunidad=Comunidad::where('nombre',$row[1])->first();
        if(!$comunidad){
           
            $usuario=User::where('email',$row[2])->first();
            $canton=Canton::where('nombre',$row[0])->first();
            
            if($usuario && $canton){
                
                $comunidad= new Comunidad([
                    'nombre'=>$row[1],
                    'codigo'=>$canton->codigo.'-'.Str::random(2),
                    'canton_id'=>$canton->id,
                    'user_id'=>$usuario->id,
                    'creadoPor'=>Auth::user()->id
                ]);
                
            }
        }
        
        
        
        return $comunidad;
    }
}
