<?php

namespace App;

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
        'first_name',
        'last_name',
        'city',
        'email',
        'photo',
        'id_image',
        'network',
        'network_profile',
        'password',
        'status',
        'ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function winners(){
        return User::where('isWinner', 1)->get();
    }

    public function getFullName(){
        return $this->first_name . ' '. $this->last_name;
    }

    public function isBanned($user_ip){
        return User::where('ip', $user_ip)->where('status', 0)->get();
    }
}
