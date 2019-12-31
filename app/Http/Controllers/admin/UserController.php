<?php

namespace App\Http\Controllers\admin;
use App\Configuration;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.user.show', compact('email', 'custom_config'));
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

    public function store(UserRequest $request)
    {
        $u = User::where('email', '=', $request->email)->get()->count();
        if ($u == 0){
            User::createUser($request->email, $request->password, $request->name, $request->surname);
            $user = User::giveRole($request->email);
            return response()->json('se ha creado exitosamente', 200);
        }else{
            return response()->json(['errors'=>['store'=>['El correo electrónico está en uso']]], 422);
        }
    }

    public function update(Request $request)
    {
        // distinta validacion ya que el json no trae contraseña
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'active' => 'required'
        ]);  
        User::where('id', '=', $request->id)->update($request->all());
        return response()->json('se ha actualizado exitosamente', 200);
    }

}
