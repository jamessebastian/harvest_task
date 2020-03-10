<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name'];

    /**
    * The users that belong to the role.
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
    * The ablilities that belong to the role.
    */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }


    /**
     * To check whether a role has the ability.
     *
     * @param  String  $abilityName
     *
     * @return boolean
     */
    public function hasAbility($abilityName)
    {

        if($this->abilities()->where('name',$abilityName)->first())
        {
            return true;
        }
        return false;

    }

    /**
     * Assign role to the user.
     */
    public function allowTo($ability)
    {
        if(is_string($ability)){
            $ability = Ability::whereName($ability)->firstOrFail();
        }
        $this->ablities()->sync($ability,false);
    }


}
