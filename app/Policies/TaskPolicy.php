<?php

namespace App\Policies;

use App\Tasks;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return rand(10,100)%2==0;
    }

    /**
     * Determine whether the user can view the tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Tasks  $tasks
     * @return mixed
     */
    public function view(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Tasks  $tasks
     * @return mixed
     */
    public function update(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can delete the tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Tasks  $tasks
     * @return mixed
     */
    public function delete(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can restore the tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Tasks  $tasks
     * @return mixed
     */
    public function restore(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tasks.
     *
     * @param  \App\User  $user
     * @param  \App\Tasks  $tasks
     * @return mixed
     */
    public function forceDelete(User $user, Tasks $tasks)
    {
        //
    }
}
