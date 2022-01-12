<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\TipoParticipante;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipoParticipantePolicy
{
    use HandlesAuthorization;

    public function GestionDeTipoParticipante(User $user)
    {
        if($user->can('G. de tipo de participantes')){
            return true;
        }
    }
    
    public function actualizar(User $user,TipoParticipante $tipoParticipante)
    {
        if($tipoParticipante->nombre=="INNAJ Inscritos/afiliados" || $tipoParticipante->nombre=="Participante socio local"  || $tipoParticipante->nombre=="Comunitario"){
            return false;
        }else{
            return true;
        }
    }


    public function eliminar(User $user,TipoParticipante $tipoParticipante)
    {
        if($tipoParticipante->nombre=="INNAJ Inscritos/afiliados" || $tipoParticipante->nombre=="Participante socio local"|| $tipoParticipante->nombre=="Comunitario" ){
            return false;
        }else{
            return true;
        }
    }

    public function crearNuevoTipoParticipante(User $user,TipoParticipante $tipoParticipante)
    {
        if($tipoParticipante->nombre != "Participante socio local"){
            return true;
        }
    }

    
}
