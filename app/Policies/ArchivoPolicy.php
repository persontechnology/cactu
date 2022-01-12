<?php

namespace cactu\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use cactu\Models\Archivo;
use cactu\User;

class ArchivoPolicy
{
    use HandlesAuthorization;

    
    // A:deivid
    // D: solo los usuarios que tengan este permiso
    public function gestionDeArchivos(User $user)
    {
        if($user->can('G. de archivos')){
            return true;
        }
    }

    // A:deivid
    // D:no hace nada esta regla
    public function implementar_aqui_otra_regla(User $user, Archivo $archivo)
    {
        //
    }
}
