<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Attention;
use App\Patient;

class ReportController extends Controller
{
    public function show () 
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.report.show', compact('email', 'custom_config'));
    }
    public function reason ()
    {
        try 
        {
            $reason = Attention::reportReasonCount();
            $custom_config = Configuration::getCustomConfig();
            $email = session()->get('email', 'error');
            return view('guardTeamUser.report.reason', compact('reason','email', 'custom_config'));
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
    public function gender ()
    {
        try 
        {
            $gender = Patient::reportGenderCount();
            $custom_config = Configuration::getCustomConfig();
            $email = session()->get('email', 'error');
            return view('guardTeamUser.report.gender', compact('gender','email', 'custom_config'));    
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
}
