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

    public function edit_users($user)
    {
        return $user->hasAnyRoles(['admin', 'author']);
    }

    public function manage_users($user)
    {
        return $user->hasAnyRoles(['admin', 'author']);
    }

    public function delete_users($user)
    {
        return $user->hasRole(['admin']);
    }
}
