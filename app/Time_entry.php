<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time_entry extends Model
{
    protected $guarded = [];

    /**
     * Get the project that owns the Time Entry.
     */
    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }

    /**
     * Get the task that owns the Time Entry.
     */
    public function tasks()
    {
        return $this->belongsTo(Tasks::class);
    }

    /**
     * Get the timesheet that owns the Time Entry.
     */
    public function timesheet()
    {
        return $this->belongsTo(TimeSheet::class);
    }
}
