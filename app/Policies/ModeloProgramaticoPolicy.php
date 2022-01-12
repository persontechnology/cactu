<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\ModeloProgramatico;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeloProgramaticoPolicy
{
    use HandlesAuthorization;
    
    public function GestionDeModeloProgramatico(User $user)
    {
       if($user->can('G. de modelo programáticos')){
           return true;
       }
    }

    public function update(User $user, ModeloProgramatico $modeloProgramatico)
    {
        //
    }

}
