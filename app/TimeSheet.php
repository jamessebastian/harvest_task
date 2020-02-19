<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $guarded = [];

    /**
     * Get the expenses for the Timesheet.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    /**
     * Get the time entries for the Timesheet.
     */
    public function time_entry()
    {
        return $this->hasMany(Time_entry::class);
    }
}
