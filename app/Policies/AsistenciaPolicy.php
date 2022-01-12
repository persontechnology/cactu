<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Registro\Asistencia;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class AsistenciaPolicy
{
    use HandlesAuthorization;
    
    
    
    public function RegistroAsistenciaActividades(User $user)
    {
        if($user->can('Registro de asistencia a actividades')){
            return true;
        }
    }

    public function puedoTomarAsistencia(User $user, Asistencia $asistencia)
    {
        if($asistencia->comunidadPoaParticipante->gestor_id==$user->id){
            if($asistencia->fecha==Carbon::now()->toDateString()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }




}
