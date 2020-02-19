<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Clients;


class Projects extends Model
{
    protected $guarded = [];

    /**
     * Get the client that owns the project.
     */
    public function clients()
    {
        return $this->belongsTo(Clients::class);
    }

    /**
     * The tasks that belong to the project.
     */
    public function tasks()
    {
        return $this->belongsToMany(Tasks::class);
    }

    /**
     * The persons that belong to the project.
     */
    public function persons()
    {
        return $this->belongsToMany(Persons::class);
    }

    /**
     * Get the expenses for the project.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    /**
     * Get the time entries for the project.
     */
    public function time_entry()
    {
        return $this->hasMany(Time_entry::class);
    }
}
