<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
use App\Http\Requests\AttentionRequest;
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
    public function store(AttentionRequest $request)
    {
        $p = Patient::where('id', '=', $request->patient_id)->count();
        if ($p == 1){
            Attention::create($request->all());
            return response()->json('se ha creado exitosamente', 200);
        }else{
            return response()->json(['errors'=>['store'=>['Error en el ID de paciente']]], 422);
        }
    }

    public function delete (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        Attention::where('id', '=', $request->id)->delete();
        return response()->json('se ha borrado exitosamente', 200);
    }

    public function update(AttentionRequest $request)
    {
        Attention::where('id', '=', $request->id)->update($request->all());
        return response()->json('se ha actualizado exitosamente', 200);
    }

}
