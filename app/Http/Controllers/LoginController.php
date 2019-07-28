<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function show()
    {
        $customConfig = Configuration::getCustomConfig();
        return view('login', compact('customConfig'));
    }
    
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], false)){
            $p = User::where('email', '=', $request->email)->get();
            session()->put('active', $p[0]->active);
            session()->put('email', $request->email);
            return response()->json('Se inició sesión correctamente', 200); 
        } else{
            return response()->json(['errors'=>['login'=>['los datos ingresados son incorrectos']]], 422);
        }      
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
