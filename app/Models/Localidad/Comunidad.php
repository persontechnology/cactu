<?php

namespace cactu\Models\Localidad;

use Illuminate\Database\Eloquent\Model;
use cactu\Models\Localidad\Canton;
use cactu\Models\Ninio;
use cactu\User;

class Comunidad extends Model
{
    protected $table='comunidad';
    

    protected $fillable = [
        'nombre', 'codigo','canton_id','user_id','creadoPor'
    ];

    // A:Deivid
    // D:una comunidad pertenece a un canton
    public function canton()
    {
        return $this->belongsTo( Canton::class , 'canton_id');
    }

    // A:Deivid
    // D:una comunidad tiene un usuario gestor
    public function usuario()
    {
        return $this->belongsTo( User::class , 'user_id');
    }

    public function usuarioGestorCoordinador($idUsuario)
    {
        $user=User::find($idUsuario);
        if($user){
            return $user;
        }else{
            return '';
        }
    }

    // una comuniadad tiene ninos
    public function ninios()
    {
        return $this->hasMany(Ninio::class);
    }



}
