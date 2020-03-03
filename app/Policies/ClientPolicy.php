<?php

namespace App\Policies;

use App\Clients;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
        return $user->hasAccess(['view-client']);
    }

    /**
     * Determine whether the user can view the clients.
     *
     * @param  \App\User  $user
     * @param  \App\Clients  $clients
     * @return mixed
     */
    public function view(User $user, Clients $clients)
    {
        //
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
    }

    /**
     * Determine whether the user can restore the clients.
     *
     * @param  \App\User  $user
     * @param  \App\Clients  $clients
     * @return mixed
     */
    public function restore(User $user, Clients $clients)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the clients.
     *
     * @param  \App\User  $user
     * @param  \App\Clients  $clients
     * @return mixed
     */
    public function forceDelete(User $user, Clients $clients)
    {
        //
    }
}
