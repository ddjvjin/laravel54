<?php

namespace App;

use App\Model;
use Illuminate\foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $fillable = [
        'name','email','password'
    ];
}
