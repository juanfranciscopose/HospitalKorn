<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InactiveUserController extends Controller
{
    public function show ()
    {
        $email = session()->get('email', 'error');
        return view('inactive', compact('email'));
    }
}
