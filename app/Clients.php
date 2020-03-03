<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projects;
use Webpatser\Uuid\Uuid;

class Clients extends Model
{
    protected $guarded = [];
   // protected $fillable = ['name','currency','address'];

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
     * Get the projects for the client.
     */
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }


}
