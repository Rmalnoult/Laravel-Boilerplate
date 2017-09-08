<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'avatar'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    /**
     * Determine if the user has a given role.
     *
     * @param $roleName (string or array) Name of the role
     *
     * @return (bool) true/false
     */
    public function hasRole($roleNames) {

        if (!is_array($roleNames)) {
            $role = $roleNames;
            $roleNames = [$role];
        }

        foreach($this->roles()->get() as $r) {
            if(in_array($r->name, $roleNames)) return true;
        }

        return false;
    }
}
