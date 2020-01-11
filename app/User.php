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
use App\Configuration;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    //users table
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'email', 'active', 'password', 'name', 'surname'
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
    public static function giveRoleDefault($email)
    {
        $user = User::where('email', '=', $email)->first();
        $user->assignRole('GuardTeam');
    }
    public static function createUser($email, $pass, $name, $surname)
    {
        $password = bcrypt($pass);
        DB::table('users')->insert([
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'surname' => $surname,
            'active' => 1
        ]);
    }
    
    public static function changePass($id, $new_pass)
    {
        $u = User::find($id);
        $u->password = bcrypt($new_pass);
        $u->save();
    }

    public static function searchPagination ($search, $number)
    {
        try 
        {
            $a = User::where('email', 'LIKE', "%$search%")
                ->orderBy('id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($a);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }
    }

    public static function getAllPagination ($number)
    {
        try 
        {
            $a =  User::orderBy('id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($a);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }
    }

    public static function notExist ($email)
    {
        try 
        {
            $u = User::where('email', '=', $email)->get()->count();
            return ($u == 0);
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }

    }
}
