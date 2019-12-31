<?php

namespace App\Http\Controllers\admin;
use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use DB;

class RoleAssignmentController extends Controller
{
    public function show () 
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.role.show', compact('email', 'custom_config'));
    }

    public function getAll ()
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    public function getAllUsersWithRole ()
    {
        $users = DB::table('users')->select('users.email', 'users.id as user_id', 'roles.id as role_id', 'roles.name')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')->orderBy('user_Id')->get();
        return response()->json($users, 200);
    }
    public function update (Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'email' => 'required',
            'roles_names' => 'required',
        ]);  
        $user = User::find($request->user_id);
        $user->syncRoles($request->roles_names);
        return response()->json(200);
    }
}
