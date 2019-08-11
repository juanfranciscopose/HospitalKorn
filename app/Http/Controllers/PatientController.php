<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    public function getPatient($patient_id)
    {  
        if (isset($patient_id)){
            $p = Patient::where('id', '=', $patient_id)->count();
            if ($p == 0){
                $result = 'No hay paciente con ese ID';
            }else{
                $p = Patient::where('id', '=', $patient_id)->get();
                $result = $p[0];
            }
            return response()->json($result, 200);
        }else{
            return response()->json('error en id paciente', 422);
        }
    }        
    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.patient.show', compact('email', 'custom_config'));
    }

    public function getAll()
    {
        $patients = Patient::orderBy('id', 'DESC')->get();
        return response()->json($patients, 200);
    }

    public function delete (Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        Attention::where('patient_id', '=', $request->id)->delete();
        Patient::where('id', '=', $request->id)->delete();
        return response()->json('se ha borrado exitosamente', 200);
    }

    public function store (PatientRequest $request)
    {
        $p = Patient::where('clinical_history_number', '=', $request->clinical_history_number)->get()->count();
        if ($p == 0){
            $p = Patient::where('document_number', '=', $request->document_number)->get()->count();
            if ($p == 0){
                Patient::create($request->all());
                return response()->json('se ha creado exitosamente', 200);
            }else{
                return response()->json(['errors'=>['store'=>['El número de documento está en uso']]], 422);
            }
        }else{
            return response()->json(['errors'=>['store'=>['El número de historia clínica está en uso']]], 422);
        }
    }
    
    public function update(PatientRequest $request)
    {
        Patient::where('clinical_history_number', '=', $request->clinical_history_number)->update($request->all());
        return response()->json('se ha actualizado exitosamente', 200);
    }

}
