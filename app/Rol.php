<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\User;
use App\Configuration;
use DB;

class Rol extends Model
{
    public static function giveRoleDefault($email)
    {
        try 
        {
            $user = User::where('email', '=', $email)->first();
            $user->assignRole('GuardTeam');
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAll()
    {
        try 
        {
            return Role::all();
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }

    }

    public static function searchPagination ($search, $number)
    {
        try 
        {
            $users = DB::table('users')->select('users.email', 'users.id as user_id', 'roles.id as role_id', 'roles.name')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('users.email', 'LIKE', "%$search%")
                ->orderBy('user_Id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($users);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAllUsersWithRole ($number)
    {
        try 
        {
            $users = DB::table('users')->select('users.email', 'users.id as user_id', 'roles.id as role_id', 'roles.name')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->orderBy('user_Id' , 'DESC')
                ->paginate($number);
            $answer = Configuration::generatePagination($users);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function updateRol($user_id, $roles )
    {
        try 
        {
            $user = User::find($user_id);
            $user->syncRoles($roles);
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}
