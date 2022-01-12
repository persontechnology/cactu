<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Poa\Poa;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoaPolicy
{
    use HandlesAuthorization;
    
    public function crearPoaActividad(User $user, Poa $poa)
    {
        if($poa->planificacionModelo->planificacion->estado=="proceso"){
            if(!$poa->poaActividad){
                return true;
            }
        }
    }

    public function actualizarPoaActividad(User $user, Poa $poa)
    {
        if($poa->planificacionModelo->planificacion->estado=="proceso"){
            if($poa->poaActividad){
                return true;
            }
        }
    }

    //A:Fabian Lopez
    //
    public function crearPoaCuentaContable(User $user, Poa $poa)
    {
        if($poa->planificacionModelo->planificacion->estado=="proceso"){
            if(!$poa->poaCuentaContable){
                return true;
            }
        }
    }

    public function actualizarPoaCuentaContable(User $user, Poa $poa)
    {
        if($poa->planificacionModelo->planificacion->estado=="proceso"){
            if($poa->poaCuentaContable){
                return true;
            }
        }
    }
    public function crearNuevosMateriales(User $user,Poa $poa)
    {
        if($poa->planificacionModelo->planificacion->estado=="proceso"){
            if($poa->poaCuentaContable){
                return true;
            }
        }
    }

}
