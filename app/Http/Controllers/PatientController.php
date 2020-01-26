<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Patient;
use App\PatientNN;
use App\Attention;
use App\Http\Requests\PatientRequest;

use App\Http\Requests\DeleteRequest;

class PatientController extends Controller
{
    public function getPatient($patient_chn)
    {  
        try 
        {
            if (isset($patient_chn))
            {
                $p = Patient::getPatient($patient_chn);
                return response()->json($p, 200);
            }
            else
            {
                return response()->json('error en Numero de Historia Clinica del paciente', 422);
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
            $answer = Patient::createPatient($request);
            return response()->json(['errors'=>['store'=>[$answer['message']]]], $answer['http_status']);
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
            if (Patient::validateDocumentNumber($request->document_number, $request->clinical_history_number))
            {
                Patient::where('clinical_history_number', '=', $request->clinical_history_number)->update($request->all());
                return response()->json('se ha actualizado exitosamente', 200);
            }
            else
            {
                return response()->json(['errors'=>['update'=>['Numero de Documento repetido']]], 422);
            }
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        } 
    }

    public function getPatientFullname ($patient_id)
    {
        try 
        {
            $fullname = Patient::getPatientFullname($patient_id);
            return response()->json($fullname, 200);
        } 
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        } 
    }
}
