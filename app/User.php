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
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the clients for the user.
     */
    public function clients()
    {
        return $this->hasMany(Clients::class);
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
     * To show the form to edit clients.
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

//    public function hasAccess(array $permissions)
//    {
//        foreach ($permissions as $permission) {
//            if($this->)
//        }
//
//    }
//
//
//
//    public function hasPermission(string $permission)
//    {
//        $this->per
//
//    }














}
