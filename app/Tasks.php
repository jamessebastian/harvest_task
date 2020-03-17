<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Tasks extends Model
{
    protected $guarded = [];

    /**
     * For overriding default behaviour;
     */
    public static function boot()
    {
        parent::boot();

        //creates uuid
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate();
        });
    }

    /**
     * Sets uuid as Route Key Name;
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Get the organisation that owns the user.
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * The projects that belong to the Task.
     */
    public function projects()
    {
        return $this->belongsToMany(Projects::class);
    }

    /**
     * Get the time entry for the Task.
     */
    public function time_entry()
    {
        return $this->hasMany(Time_entry::class);
    }
}
