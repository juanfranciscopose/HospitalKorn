<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use Notifiable;
    protected $table = 'patients';
    public $timestamps = false;
    //fillable -> campos a guardar, si decimos request->ALL() solamente guarda los especificados 
    protected $fillable = [
        'clinical_history_number', 
        'name', 
        'surname', 
        'birthdate', 
        'party', 
        'town', 
        'address', 
        'gender', 
        'document_type', 
        'document_number', 
        'folder_number', 
        'telephone', 
        'social_work'
    ];

    public static function getPatient ($id)
    {
        $p = Patient::where('id', '=', $id)->count();
        if ($p == 0){
            $result = 'No hay paciente con ese ID';
        }
        else
        {
            $p = Patient::where('id', '=', $id)->get();
            $result = $p[0];
        }
        return $result;
    }
}
