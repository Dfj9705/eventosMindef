<?php

namespace App\Policies;

use App\User;
use App\Registro;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistroPolicy
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

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Registro  $registro
     * @return mixed
     */

    public function delete(User $user, Registro $registro)
    {
        return $user->id === $registro->user_id;
    }
}
