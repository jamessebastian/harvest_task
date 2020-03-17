<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $guarded = [];

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
     * Get the projects for the organisation.
     */
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }

    /**
     * Get the tasks for the organisation.
     */
    public function tasks()
    {
        return $this->hasMany(Tasks::class);
    }

}
