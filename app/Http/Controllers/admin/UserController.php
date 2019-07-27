<?php

namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show()
    {
        //refactoring -> getConfig()
        $email = session()->get('email', 'error');
        return view('admin.user.show', compact('email'));
    }

    public function getAll()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

    public function delete()
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

}
