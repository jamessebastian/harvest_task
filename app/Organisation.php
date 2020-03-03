<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /**
     * Get the users for the organisation.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the clients for the organisation.
     */
    public function clients()
    {
        return $this->hasMany(Clients::class);
    }

    /**
     * Get the tasks for the organisation.
     */
    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

}
