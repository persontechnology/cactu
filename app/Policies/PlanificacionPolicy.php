<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Planificacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanificacionPolicy
{
    use HandlesAuthorization;
    

    /**
     * Determine whether the user can create planificacions.
     *
     * @param  \cactu\User  $user
     * @return mixed
     */
    public function GestionDePlanificacion(User $user)
    {
       if($user->can('G. de planificaciones')){
           return true;
       }
    }

    public function crear(User $user)
    {
        if(!Planificacion::where('estado','proceso')->first()){
            return true;
        }
    }
    public function actualizar(User $user, Planificacion $planificacion)
    {
        if($planificacion->estado=='proceso'){
            return true;
        }
    }
     public function eliminar(User $user, Planificacion $planificacion)
    {
        if($planificacion->estado=='proceso'){
            return true;
        }
    }

    public function creaPlanificacionModelo(User $user,Planificacion $planificacion)
    {
        if($planificacion->estado=='proceso'){
            return true;
        }
    }   
    
}
