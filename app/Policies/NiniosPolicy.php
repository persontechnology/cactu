<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Ninio;
use cactu\Models\TipoParticipante;
use Illuminate\Auth\Access\HandlesAuthorization;

class NiniosPolicy
{
    use HandlesAuthorization;
    
    public function GestionDeNinios(User $user)
    {
        if($user->can('G. de niños')){
            return true;
        }
    }

    public function crearNoPersonal(User $user, Ninio $ninio)
    {
        return true;
    }


    // A:deivid
    // D: actualizar participante si pertenece a la comunidad del gestor
    public function actualizarMiPersonal(User $user, Ninio $ninio)
    {
        $comunidades_ids=$user->comunidades->pluck('id')->toArray();
        if(in_array($ninio->comunidad->id,$comunidades_ids)){
            return true;
        }
    }

    // A:deivid
    // D: eliminar participante si pertenece a la comunidada de gestor
    public function eliminarMiPersonal(User $user, Ninio $ninio)
    {
        $comunidades_ids=$user->comunidades->pluck('id')->toArray();
        if(in_array($ninio->comunidad->id,$comunidades_ids)){
            return true;
        }
    }

    // A:deivid
    // D: ver e imprimir infromacion del  participante si pertenece a la comunidada de gestor
    public function informacionMiPersonal(User $user, Ninio $ninio)
    {
        $comunidades_ids=$user->comunidades->pluck('id')->toArray();
        if(in_array($ninio->comunidad->id,$comunidades_ids)){
            return true;
        }
    }

     // A:deivid
    // D: ver e imprimir infromacion del  participante si pertenece a la comunidada de gestor
    public function informacionMiQr(User $user, Ninio $ninio)
    {
        $comunidades_ids=$user->comunidades->pluck('id')->toArray();
        if(in_array($ninio->comunidad->id,$comunidades_ids)){
            return true;
        }
    }

    //Fabian lopez
    //Politica para ver si es afiliado 
    public function verAfiliado(User $user, Ninio $ninio)
    {
        if($ninio->tipoParticipante->nombre=="INNAJ Inscritos/afiliados"){
            return true;
        }
    }

    // A:Fabian
    // D: verificar la comunidad de gestor para ingresar sus participantes en sus comunidades
    public function verificarComunidadNinio(User $user,Ninio $ninio)
    {
        if($ninio->tipoParticipante->nombre=="INNAJ Inscritos/afiliados"){
            if(in_array($ninio->comunidad->id,$user->comunidades->pluck('id')->toArray())){
                return true;
            }
        }
    }
}
