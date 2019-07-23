<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
class AttentionController extends Controller
{
    public function show()
    {
        //refactoring -> getConfig()
        $email = session()->get('email', 'error');
        return view('guardTeamUser.attention.show', compact('email'));
    }
    public function getAll()
    {
        $attentions = Attention::orderBy('id', 'DESC')->get();
        foreach ($attentions as $a) {
            $p = Patient::where('id', '=', $a->patient_id)->get();   
            $a['patient'] = $p[0];
        }
        return response()->json($attentions, 200);
    }
}
