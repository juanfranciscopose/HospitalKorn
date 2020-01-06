<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Attention;

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
        $reason = Attention::reportReasonCount();
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.report.reason', compact('reason','email', 'custom_config'));
    }
}
