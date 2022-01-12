<?php

namespace cactu\Models;

use cactu\User;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    //A:deivid
    // D:un archivo tiene usuarios compartidos
    public function users_m()
    {
        return $this->belongsToMany(User::class, 'archivousers', 'archivo_id', 'user_id');
    }

    // A:deivid
    // d:  un archivo y usuario tiene un archico comaprtido
    public function hasUser($idArchivo,$idUser)
    {
        $ar= Archivouser::where(['archivo_id'=>$idArchivo,'user_id'=>$idUser])->first();
        if($ar){
            return true;
        }
        return false;
    }

    public function buscarPorId()
    {
        # code...
    }
}
