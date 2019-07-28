<?php

namespace App\Http\Controllers;
use App\Configuration;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function show(){
        $customConfig = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('article', compact('email', 'customConfig'));
    }
}
