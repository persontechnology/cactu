<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Poa\PoaParticipantes\ComunidadPoaParticipante;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComunidadPoaParticipantePolicy
{
    use HandlesAuthorization;
  
    public function accederAsistencias(User $user, ComunidadPoaParticipante $comunidadPoaParticipante)
    {
        if($comunidadPoaParticipante->gestor_id==$user->id){
            return true;
        }else{
            return false;
        }
            
    }
    public function accederAsistenciasPfd(User $user, ComunidadPoaParticipante $comunidadPoaParticipante)
    {
        if($comunidadPoaParticipante->gestor_id==$user->id ||  $user->hasRole('Administrador')){
            return true;
        }else{
            return false;
        }
            
    }
   

    public function puedeCrearAsistencia(User $user, ComunidadPoaParticipante $comunidadPoaParticipante)
    {
        if($comunidadPoaParticipante->gestor_id==$user->id){
            //si tiene este comunidadpoParticiapnte asistencias en estado  creado y fecha hoy no puede crear
           if(count($comunidadPoaParticipante->asisHoyEstadoCreado)>0){
               return false;
           }else{
               return true;
           }

        }else{
            return false;
        }
            
    }
    

}
