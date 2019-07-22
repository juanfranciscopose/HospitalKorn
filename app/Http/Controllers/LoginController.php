<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }
    
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], false)){
            session()->put('email', $request->email);
            return response()->json('Se inició sesión correctamente', 200); 
        } else{
            return response()->json(['errors'=>['login'=>['los datos ingresados son incorrectos']]], 422);
        }      
    }
    
    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
