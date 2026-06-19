<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'userId';
    public $timestamps = false;

    protected $fillable = ['userName', 'password'];
    protected $hidden = ['password'];
}