<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\User;

class PasswordController extends Controller
{
    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('pass.show', compact('email', 'custom_config'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);  
        $id = session()->get('id', 'error');
        User::changePass($id, $request->password);
        return response()->json('actualización de clave exitosa', 200);
    }
}
