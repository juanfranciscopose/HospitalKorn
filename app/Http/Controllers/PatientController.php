<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\DeleteRequest;

class PatientController extends Controller
{
    //refactoring
    public function getPatientsWithAttention()// fuera de uso
    {  
        $patient_with_attention = Attention::distinct()->get(['patient_id'])->count();
        if ($patient_with_attention == 0){
            return response()->json(['errors'=>['load'=>['no se registran datos pacientes atendidos']]],422);
        }else{
            $patients = array();
            $id_with_attentions = Attention::distinct()->get(['patient_id']);
            foreach ($id_with_attentions as $id) {
                $p = Patient::where('id', '=', $id->patient_id)->get();
                array_push($patients, $p[0]);
            }
            return response()->json($patients, 200);
        }    
    }     

    public function getPatient($patient_id)
    {  
        try 
        {
            if (isset($patient_id))
            {
                $p = Patient::getPatient($patient_id);
                return response()->json($p, 200);
            }
            else
            {
                return response()->json('error en id paciente', 422);
            }
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }   
         
    public function getSearch (Request $request) 
    {
        try 
        {
            $search = \Request::get('search');
            $custom_config = Configuration::getCustomConfig();
            $answer = Patient::searchPagination($search, $custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
        
    }

    public function show()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.patient.show', compact('email', 'custom_config'));
    }

    public function getAll(Request $request)
    {
        try 
        {
            $custom_config = Configuration::getCustomConfig();
            $answer = Patient::getAllPagination($custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function delete (DeleteRequest $request)
    {
        try 
        {
            Attention::where('patient_id', '=', $request->id)->delete();
            Patient::where('id', '=', $request->id)->delete();
            return response()->json('se ha borrado exitosamente', 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function store (PatientRequest $request)
    {
        try 
        {
            $p = Patient::where('clinical_history_number', '=', $request->clinical_history_number)->get()->count();
            if ($p == 0)
            {
                $p = Patient::where('document_number', '=', $request->document_number)->get()->count();
                if ($p == 0)
                {
                    Patient::create($request->all());
                    return response()->json('se ha creado exitosamente', 200);
                }
                else
                {
                    return response()->json(['errors'=>['store'=>['El número de documento está en uso']]], 422);
                }
            }
            else
            {
                return response()->json(['errors'=>['store'=>['El número de historia clínica está en uso']]], 422);
            }
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
    
    public function update(PatientRequest $request)
    {
        try 
        {
            Patient::where('clinical_history_number', '=', $request->clinical_history_number)->update($request->all());
            return response()->json('se ha actualizado exitosamente', 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        } 
    }
}
