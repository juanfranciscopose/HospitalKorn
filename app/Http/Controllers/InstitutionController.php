<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Institution;

class InstitutionController extends Controller
{
    public function show()
    {
        $customConfig = Configuration::getCustomConfig();
        return view('institution.show', compact('customConfig'));
    }

    public function getBySanitaryRegionId($sanitary_region_id)
    {    
        $i = Institution::where('sanitary_region_id', '=', $sanitary_region_id)->get()->count();
        if ($i == 0){
            return response()->json(['errors'=>['getBySanitaryRegionId'=>['No hay instituciones guardadas en esa región']]], 422);
        }else{
            $i = Institution::where('sanitary_region_id', '=', $sanitary_region_id)->get();
            return response()->json($i, 200);
        }
    }
    public function getAll()
    {
        $institutions = Institution::all();
        return response()->json($institutions, 200);
    }
    
   /* public function getInstitution($id)
    {
        if (isset($id)){
            $institutions = Institution::where('id', '=', $id)->get()->first();
            return response()->json($institutions, 200);
        }else{
            return response()->json('error en id', 422);
        }
    }*/
   
}
