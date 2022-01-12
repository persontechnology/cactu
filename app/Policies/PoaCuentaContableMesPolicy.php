<?php

namespace cactu\Policies;

use cactu\Models\Poa\PoaCuentas\PoaCuentaContableMes;
use Illuminate\Auth\Access\HandlesAuthorization;
use cactu\User;

class PoaCuentaContableMesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function verificarMesExistentePoaContable(User $user,PoaCuentaContableMes $poaCuentaContableMes)
    {
        if($poaCuentaContableMes->cuentaContablePoaCuenta->cuentaContable->nombre=="Materiales"){
            return true;
        }
    }
}
