<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserImages extends Model
{
    public $timestamps = false;
    protected $table = 'user_images';
    protected $fillable = ['name'];
}
