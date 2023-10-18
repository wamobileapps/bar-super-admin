<?php

namespace App\Models;

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
    Protected $table = 't_user';
    protected $fillable = [
        'name', 'email', 'password','full_name','user_id','username','type','provider_id','device_token','device_type','fcm_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
