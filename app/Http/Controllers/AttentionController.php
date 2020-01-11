<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use App\Patient;
use App\Attention;
use App\Http\Requests\AttentionRequest;
use App\Http\Requests\DeleteRequest;

class AttentionController extends Controller
{
    
    public function getSearch (Request $request) 
    {
        try
        {
            $search = \Request::get('search');//static
            $custom_config = Configuration::getCustomConfig();
            $answer =  Attention::searchPagination($search, $custom_config['pagination']['pagination']);
            return response()->json($answer, 200);
        }
        catch (Exception $e)
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
        
    }

    public function getAll ()
    {  
        try
        {
            $custom_config = Configuration::getCustomConfig();
            $answer =  Attention::getAllPagination($custom_config['pagination']['pagination']);
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
        return view('guardTeamUser.attention.show', compact('email', 'custom_config'));
    }

    public function store(AttentionRequest $request)
    {
        try 
        {
            if (Patient::isExists($request->patient_id))
            {
                Attention::create($request->all());
                return response()->json('se ha creado exitosamente', 200);
            }
            else
            {
                return response()->json(['errors'=>['store'=>['Error en el ID de paciente']]], 422);
            }
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
            Attention::deleteAttention($request->id);
            return response()->json('se ha borrado exitosamente', 200);
        } 
        catch (Exception $e) 
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
        
    }

    public function update(AttentionRequest $request)
    {
        try 
        {
            Attention::where('id', '=', $request->id)->update($request->all());
            return response()->json('se ha actualizado exitosamente', 200);
        } 
        catch (Exception $e) 
        {
            return response()->json("no se pudo procesar la solicitud. Error: "+$e, 409);
        }
        
    }
}
