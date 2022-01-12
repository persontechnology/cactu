<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\PlanificacionModelo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanificacionModeloPolicy
{
    use HandlesAuthorization;
    
   
    
    public function eliminar(User $user, PlanificacionModelo $planificacionModelo)
    {
        if($planificacionModelo->planificacion->estado=="proceso"){
            return true;
        }
    }

    public function crearPoa(User $user,PlanificacionModelo $planificacionModelo)
    {
        if($planificacionModelo->planificacion->estado=="proceso"){
            return true;
        }
    }
    
}
