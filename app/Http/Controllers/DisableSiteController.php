<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;

class DisableSiteController extends Controller
{
    public function show ()
    {
        $customConfig = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('sitedisabled', compact('email', 'customConfig'));
    }
}
