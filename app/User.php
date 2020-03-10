<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    protected $guarded = [];






    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /**
     * Get the organisation that owns the user.
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the projects for the user.
     */
    public function projects()
    {
        return $this->hasMany(Projects::class);
    }


    /**
     * Get the expenses for the project.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }

    /**
     * Get the time sheet for the user.
     */
    public function timesheets()
    {
        return $this->hasMany(TimeSheet::class);
    }







    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Assign role to the user.
     */
    public function assignRole($role)
    {
        if(is_string($role)){
            $role = Role::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role,false);
    }

    /**
     * To check whether user has any roles in the given array
     *
     * @param  Array  $roles
     *
     * @return boolean
     */
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name',$roles)->first())
        {
            return true;
        }
        return false;
    }

    /**
     * To check whether a user has the role.
     *
     * @param  String  $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first())
        {
            return true;
        }
        return false;
    }

    /**
     * To check whether a user has the ability.
     *
     * @param  String  $abilityName
     *
     * @return boolean
     */
    public function hasAbility($abilityName)
    {
        $flag = false;
        $userRoles = $this->roles;
        foreach ($userRoles as $userRole){
            $flag = ($flag or $userRole->hasAbility($abilityName));
        }
        return $flag;
    }




//    public function hasAccess(array $permissions)
//    {
//        foreach ($permissions as $permission) {
//            if($this->hasPermission($permission)){
//                  return true;
//             }
//        }
//        return false;
//    }
//
//
//
//    public function hasPermission(string $permission)
//    {
//        $permissions = json_decode($this->permissions,true);
//        return $permissions[$permission]??false;
//
//    }














}
