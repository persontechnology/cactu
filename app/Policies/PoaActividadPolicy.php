<?php

namespace cactu\Policies;

use cactu\User;
use cactu\Models\Poa\PoaActividad;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoaActividadPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any poa actividads.
     *
     * @param  \cactu\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the poa actividad.
     *
     * @param  \cactu\User  $user
     * @param  \cactu\Models\Poa\PoaActividad  $poaActividad
     * @return mixed
     */
    public function view(User $user, PoaActividad $poaActividad)
    {
        //
    }

    /**
     * Determine whether the user can create poa actividads.
     *
     * @param  \cactu\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the poa actividad.
     *
     * @param  \cactu\User  $user
     * @param  \cactu\Models\Poa\PoaActividad  $poaActividad
     * @return mixed
     */
    public function update(User $user, PoaActividad $poaActividad)
    {
        //
    }

    /**
     * Determine whether the user can delete the poa actividad.
     *
     * @param  \cactu\User  $user
     * @param  \cactu\Models\Poa\PoaActividad  $poaActividad
     * @return mixed
     */
    public function delete(User $user, PoaActividad $poaActividad)
    {
        //
    }

    /**
     * Determine whether the user can restore the poa actividad.
     *
     * @param  \cactu\User  $user
     * @param  \cactu\Models\Poa\PoaActividad  $poaActividad
     * @return mixed
     */
    public function restore(User $user, PoaActividad $poaActividad)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the poa actividad.
     *
     * @param  \cactu\User  $user
     * @param  \cactu\Models\Poa\PoaActividad  $poaActividad
     * @return mixed
     */
    public function forceDelete(User $user, PoaActividad $poaActividad)
    {
        //
    }
}
