<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientNNRequest;
use App\Configuration;
use App\PatientNN;
use App\Patient;
use App\Attention;

class PatientNNController extends Controller
{
    public function show ()
    {
        $custom_config = Configuration::getCustomConfig();
        $email = session()->get('email', 'error');
        return view('guardTeamUser.patient.nn.show', compact('email', 'custom_config'));
    }
    public function getAll (Request $request)
    {
        try 
        {
            $custom_config = Configuration::getCustomConfig();
            $answer = PatientNN::getAllPagination($custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }

    public function store (PatientNNRequest $request)
    {
        try 
        {
            if (Patient::isClinicalNumberHistoryExists($request->clinical_history_number))
            {
                PatientNN::createPatientNN($request->clinical_history_number);
                return response()->json('se ha creado exitosamente', 200);
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
            PatientNN::where('clinical_history_number', '=', $request->clinical_history_number)->delete();
            $answer = Patient::createPatient($request);
            return response()->json($answer['message'], $answer['http_status']);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
    }
}