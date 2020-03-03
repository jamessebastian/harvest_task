<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class roles
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
     * Check if a user can edit users.
     *
     * @param  \App\User  $user
     *
     * @return boolean
     */
    public function is_admin($user)
    {
        return $user->hasRole(['admin']);
    }

    /**
     * Check if a user can edit users.
     *
     * @param  \App\User  $user
     *
     * @return boolean
     */
    public function edit_users($user)
    {
        return $user->hasAnyRoles(['admin', 'author']);
    }

    /**
     * Check if a user can manage users.
     *
     * @param  \App\User  $user
     *
     * @return boolean
     */
    public function manage_users($user)
    {
        return $user->hasAnyRoles(['admin', 'author']);
    }

    /**
     * Check if a user can delete users.
     *
     * @param  \App\User  $user
     *
     * @return boolean
     */
    public function delete_users($user)
    {
        return $user->hasRole(['admin']);
    }

}
