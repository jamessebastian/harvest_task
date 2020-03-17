<?php

namespace App\Policies;

use App\Clients;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasAbility('view-client');
    }


    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      //  return false;
         return $user->hasAbility('create-client');
    }

    /**
     * Determine whether the user can update the clients.
     *
     * @param  \App\User  $user
     * @param  \App\Clients  $clients
     * @return mixed
     */
    public function update(User $user, Clients $clients)
    {
        //return false;
        return $user->hasAbility('update-client') and $user->organisation==$clients->organisation;
    }

    /**
     * Determine whether the user can delete the clients.
     *
     * @param  \App\User  $user
     * @param  \App\Clients  $clients
     * @return mixed
     */
    public function delete(User $user, Clients $clients)
    {
        return $user->hasAbility('delete-client') and $user->organisation==$clients->organisation;
    }

}
