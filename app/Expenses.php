<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $guarded = [];

    /**
     * Get the project that owns the expense.
     */
    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }

    /**
     * Get the timesheet that owns the expense.
     */
    public function timesheet()
    {
        return $this->belongsTo(TimeSheet::class);
    }

}
