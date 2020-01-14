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
use App\Rol;

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
        try 
        {
            $user = User::find($id);
            $roles = Rol::getAll();
            foreach ($roles as $r) 
            {
                if ($user->hasRole($r))
                {
                    $user->removeRole($r);
                }
            }
            User::where('id', '=', $id)->delete();
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function createUser($email, $pass, $name, $surname)
    {
        try 
        {
            $password = bcrypt($pass);
            DB::table('users')->insert([
                'email' => $email,
                'password' => $password,
                'name' => $name,
                'surname' => $surname,
                'active' => 1
            ]);
            Rol::giveRoleDefault($email);
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
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
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllPagination ($number)
    {
        try 
        {
            $a = User::orderBy('id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($a);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
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
            throw new Exception($e->getMessage());
        }

    }
}
