<?php

namespace App\Http\Controllers\admin;
use App\Configuration;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        $customConfig = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.user.show', compact('email', 'customConfig'));
    }

    public function getAll()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);     
        if ($request->id != session()->get('id', 'error')){
            User::deleteUser($request->id);
            return response()->json('se ha borrado exitosamente', 200);
        }  
        return response()->json(['errors'=>['delete'=>['No se puede borrar el usuario actual']]], 422);

    }

    public function store()
    {

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'email' => 'required',
            'active' => 'required'
        ]);  
        User::where('id', '=', $request->id)->update($request->all());
        return response()->json('se ha actualizado exitosamente', 200);
    }

}
