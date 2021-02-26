<?php

namespace App\Policies;

use App\Models\Transplantation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransplantationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAccess('user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transplantation  $transplantation
     * @return mixed
     */
    public function view(User $user, Transplantation $transplantation)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transplantation  $transplantation
     * @return mixed
     */
    public function update(User $user, Transplantation $transplantation)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transplantation  $transplantation
     * @return mixed
     */
    public function delete(User $user, Transplantation $transplantation)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transplantation  $transplantation
     * @return mixed
     */
    public function restore(User $user, Transplantation $transplantation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transplantation  $transplantation
     * @return mixed
     */
    public function forceDelete(User $user, Transplantation $transplantation)
    {
        //
    }
}
