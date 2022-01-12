<?php

namespace cactu\Policies;

use cactu\Models\Acta;
use Illuminate\Auth\Access\HandlesAuthorization;
use cactu\User;

class ActasPolicy
{
    use HandlesAuthorization;

    
   
    public function GestionDeActas(User $user)
    {
       if($user->can('G. de acta entrega recepción')){
           return true;
       }
    }
    public function crear(User $user,Acta $acta)
    {
        return true;
    }

    public function cambioEstadoActa(User $user,Acta $acta)
    {
        if($acta->estado=="Planificando" && $acta->listadoMateriales->count()>0){
            return true;
        }
    }
    public function verActa(User $user,Acta $acta)
    {
        $actaComunidad=$acta->comunidadActa->comunidad->usuario->id;
        if($acta->estado!="Planificando" && $actaComunidad==$user->id){
            return true;
        }
    }
}
