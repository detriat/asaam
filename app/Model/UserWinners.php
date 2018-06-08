<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWinners extends Model
{
    protected $table = 'users';

    public function scopeWinners($users, $status)
    {
        return $users->where('isWinner', $status);
    }
}
