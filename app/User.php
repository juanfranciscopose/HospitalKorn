<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    public static function deleteUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        foreach ($roles as $r) {
            if ($user->hasRole($r)){
                $user->removeRole($r);
            }
        }
        User::where('id', '=', $id)->delete();
    }
    public static function createUser($email, $pass)
    {
        $password = bcrypt($pass);
        DB::table('users')->insert([
            'email' => $email,
            'password' => $password,
            'active' => 1
        ]);
    }
}
