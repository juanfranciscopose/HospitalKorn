<?php

namespace App\Http\Controllers\admin;
use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rol;
use App\Http\Requests\UpdateRolRequest; 

class RoleAssignmentController extends Controller
{

    public function getSearch (Request $request)
    {
        try
        {
            $search = \Request::get('search');
            $custom_config = Configuration::getCustomConfig();
            $answer =  Rol::searchPagination($search, $custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    } 

    public function show () 
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.role.show', compact('email', 'custom_config'));
    }

    public function getAll ()
    {
        try
        {
            $roles = Rol::getAll();
            return response()->json($roles, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function getAllUsersWithRole ()
    {
        try
        {
            $custom_config = Configuration::getCustomConfig();
            $users = Rol::getAllUsersWithRole($custom_config['pagination']['pagination']);
            return response()->json($users, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function update (UpdateRolRequest $request)
    { 
        try
        {
            if ($request->user_id == session()->get('id', 'error'))
            {
                return response()->json(['errors'=>['update'=>['no puede cambiar su rol usted mismo siendo ADMIN']]], 422);
            }
            Rol::updateRol($request->user_id, $request->roles_names);
            return response()->json(200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
}
