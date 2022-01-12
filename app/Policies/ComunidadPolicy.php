<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Localidad\Comunidad;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComunidadPolicy
{
    use HandlesAuthorization;
    
    public function GestionDeComunidad(User $user)
    {
       if($user->can('G. de comunidades')){
           return true;
       }
    }


    public function eliminarComunidad(User $user,Comunidad $model)
    {
       if($user->can('G. de comunidades')){
           if($model->nombre=="CACTU-COTOPAXI" ||$model->nombre=="CACTU-TUNGURAHUA" ){
               return false;
           }
           return true;
       }
    }

    // A:Deivid
    // D: verificar la comunidad de gestor para ingresar sus participantes en sus comunidades
    public function verificarComunidad(User $user,Comunidad $comunidad)
    {
        if(in_array($comunidad->id,$user->comunidades->pluck('id')->toArray())){
            return true;
        }
    }
    

}
