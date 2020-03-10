<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Clients;
use Webpatser\Uuid\Uuid;

class Projects extends Model
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
        //return 'slug';
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
     * Get the client that owns the project.
     */
    public function clients()
    {
        return $this->belongsTo(Clients::class)->withTimestamps();
    }

    /**
     * The tasks that belong to the project.
     */
    public function tasks()
    {
        return $this->belongsToMany(Tasks::class)->withTimestamps();
    }

    /**
     * The users that belong to the project.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
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
