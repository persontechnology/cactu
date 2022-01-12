<?php

namespace cactu\Policies;

use cactu\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuariosPolicy
{
    use HandlesAuthorization;
    
    public function GestionDeUsuarios(User $user)
    {
       if($user->can('G. de usuarios')){
           return true;
       }
    }


    // A:Deivid
    // D:permisos para gestion de coordinadores
    public function GestionDeCoordinadores(User $user)
    {
       if($user->can('G. de coordinadores')){
           return true;
       }
    }

    // A:Deivid
    // D:permisos para gestion de gestores
    public function GestionDeGestores(User $user)
    {
       if($user->can('G. de gestores')){
           return true;
       }
    }

    public function GestionDeParticipantes(User $user)
    {
       if($user->can('G. de participantes')){
           return true;
       }
    }
    
    public function eliminarUsuario(User $user,User $model)
    {
        if($model->hasRole('Administrador')){
            return false;
        }
        return $user->id!=$model->id;
    }

    public function actualizar(User $user,User $model)
    {
        if($model->hasRole('Administrador') && $model->id==$user->id){
            return false;
        }
        return $user->id!=$model->id;
    }

   
}
