<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
use App\Http\Requests\AttentionRequest;
class AttentionController extends Controller
{
    public function getSearch (Request $request) 
    {
        $s = \Request::get('search');
        $custom_config = Configuration::getCustomConfig();
        $a = Attention::where('reason', 'LIKE', "%$s%")
            ->paginate($custom_config['pagination']['pagination']);
        $answer = [
            'pagination' => [
                'total' => $a->total(),
                'current_page' => $a->currentPage(),
                'per_page' => $a->perPage(),
                'last_page' => $a->lastPage(),
                'from' => $a->firstItem(),
                'to' => $a->lastItem()
            ],
            'attentions' => $a
        ];
        return response()->json($answer, 200);
    }
    public function getAll ()
    {
        $attentions = Attention::all();
  
        $custom_config = Configuration::getCustomConfig();
        $a = Attention::paginate($custom_config['pagination']['pagination']);
        $answer = [
            'pagination' => [
                'total' => $a->total(),
                'current_page' => $a->currentPage(),
                'per_page' => $a->perPage(),
                'last_page' => $a->lastPage(),
                'from' => $a->firstItem(),
                'to' => $a->lastItem()
            ],
            'attentions' => $a
        ];
        return response()->json($answer, 200);
    }
    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.attention.show', compact('email', 'custom_config'));
    }

    public function store(AttentionRequest $request)
    {
        $p = Patient::where('id', '=', $request->patient_id)->count();
        if ($p == 1)
        {
            Attention::create($request->all());
            return response()->json('se ha creado exitosamente', 200);
        }
        else
        {
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
