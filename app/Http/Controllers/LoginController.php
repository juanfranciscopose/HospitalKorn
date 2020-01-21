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
        try 
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], false)){
                $p = User::where('email', '=', $request->email)->get();
                $customConfig = Configuration::getCustomConfig();
                session()->put('id', $p[0]->id);
                session()->put('active', $p[0]->active);
                session()->put('email', $request->email);
                session()->put('siteenabled', $customConfig['enable']['enable']);
                return response()->json('Se inició sesión correctamente', 200); 
            } else{
                return response()->json(['errors'=>['login'=>['los datos ingresados son incorrectos']]], 422);
            }     
        }
        catch (Exception $e) 
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
         
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
