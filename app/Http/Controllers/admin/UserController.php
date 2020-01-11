<?php

namespace App\Http\Controllers\admin;
use App\Configuration;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function getSearch (Request $request)
    {
        try
        {
            $search = \Request::get('search');
            $custom_config = Configuration::getCustomConfig();
            $answer =  User::searchPagination($search, $custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.user.show', compact('email', 'custom_config'));
    }

    public function getAll()
    {
        try
        {
            $custom_config = Configuration::getCustomConfig();
            $answer =  User::getAllPagination($custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function delete(DeleteRequest $request)
    {
        try
        {
            if ($request->id != session()->get('id', 'error')){
                User::deleteUser($request->id);
                return response()->json('se ha borrado exitosamente', 200);
            }  
            return response()->json(['errors'=>['delete'=>['No se puede borrar el usuario actual']]], 422);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function store(UserRequest $request)
    {
        try
        {
            if (User::notExist($request->email)){
                User::createUser($request->email, $request->password, $request->name, $request->surname);
                $user = User::giveRoleDefault($request->email);
                return response()->json('se ha creado exitosamente', 200);
            }else{
                return response()->json(['errors'=>['store'=>['El correo electrónico está en uso']]], 422);
            }
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try
        {
            User::where('id', '=', $request->id)->update($request->all());
            return response()->json('se ha actualizado exitosamente', 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

}
