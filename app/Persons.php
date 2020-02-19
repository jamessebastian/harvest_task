<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $guarded = [];

    /**
     * The projects that belong to the person.
     */
    public function projects()
    {
        return $this->belongsToMany(Projects::class);
    }

}
