<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserBlackList extends Model
{
    protected $table = 'users';

    public function scopeBanned($users, $status)
    {
        return $users->where('status', $status);
    }
}
