<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Animation extends Model
{
    //
    public $timestamps = false;
    protected $table = 'animations';
    protected $fillable = ['url'];

}
