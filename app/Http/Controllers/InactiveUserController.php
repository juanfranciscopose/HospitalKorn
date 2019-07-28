<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class InactiveUserController extends Controller
{
    public function show ()
    {
        $customConfig = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('inactive', compact('email', 'customConfig'));
    }
}
