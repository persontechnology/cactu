<?php

namespace cactu\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use cactu\User;

class MaterialPolicy
{
    use HandlesAuthorization;

   
    public function GestionMateriales(User $user)
    {
        if($user->can('G. de materiales')){
            return true;
        }
    }
}
