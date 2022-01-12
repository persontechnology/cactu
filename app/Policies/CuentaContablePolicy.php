<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\CuentaContable;
use Illuminate\Auth\Access\HandlesAuthorization;

class CuentaContablePolicy
{
    use HandlesAuthorization;
    
    
    public function GestionDeCuentaContable(User $user)
    {
        if($user->can('G. de cuentas contables')){
            return true;
        }
    }

    public function view(User $user, CuentaContable $cuentaContable)
    {
        
    }
    //verificar si la cuenta contable es diferente a materiales
    public function materialesCuentaContable(User $user, CuentaContable $cuentaContable)
    {
        if($cuentaContable->nombre!="Materiales"){
            return true;
        }
    }
    public function materialesCuentaContableCrear(User $user, CuentaContable $cuentaContable)
    {
        if($cuentaContable->nombre=="Materiales"){
            return true;
        }
    }
  
}
