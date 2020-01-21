<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuration;
use App\Http\Requests\ConfigurationRequest;
class ConfigurationController extends Controller
{
    public function show()
    {
        $customConfig = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('admin.configuration.show', compact('email', 'customConfig'));
    }

    public function getAll()
    {
        $customConfig = Configuration::getCustomConfig();
        return response()->json($customConfig, 200);
    }

    public function update(Request $request)
    {
        Configuration::updateConfig($request);
        $customConfig = Configuration::getCustomConfig();
        session()->put('siteenabled', $customConfig['enable']['enable']);
        return response()->json('se ha actualizado correctamente', 200);
    }

}
