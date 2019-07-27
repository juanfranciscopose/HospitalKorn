<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    //users table
    protected $table = 'users';
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token'
    ];
    protected $fillable = [
        'email', 'active', 'password', 'remember_token'
    ];
}
