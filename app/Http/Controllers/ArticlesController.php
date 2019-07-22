<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function show(){
        $email = session()->get('email', 'error');
        return view('article', compact('email'));
    }
}
