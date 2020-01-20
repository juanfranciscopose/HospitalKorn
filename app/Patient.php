<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Configuration;

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
    public static function reportGenderCount ()
    {
        try
        {
            $gender = array(
                'male' => Patient::where('gender', '=', 'MASCULINO')->count(),
                'female' => Patient::where('gender', '=', 'FEMENINO')->count(),
                'shemale' => Patient::where('gender', '=', 'TRANS')->count(),
                'other' => Patient::where('gender', '=', 'OTROS')->count(),
            );
            return $gender;
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    public static function getAllPagination ($number)
    {
        try 
        {
            $p = Patient::orderBy('document_number', 'DESC')->paginate($number);
            $answer = Configuration::generatePagination($p);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function searchPagination ($search, $number)
    {
        try 
        {
            $p = Patient::where('document_number', 'LIKE', "%$search%")
                ->orWhere('clinical_history_number', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('surname', 'LIKE', "%$search%")
                ->orderBy('document_number', 'DESC')
                ->paginate($number);
            $answer = Configuration::generatePagination($p);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function isExists ($patient_id)
    {
        try 
        {
            $p = Patient::where('id', '=', $patient_id)->count();
            return ($p == 1);
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public static function getPatient ($id)
    {
        try 
        {
            $p = Patient::where('id', '=', $id)->count();
            if ($p == 0)
            {
                $result = 'No hay paciente con ese ID';
            }
            else
            {
                $p = Patient::where('id', '=', $id)->get();
                $result = $p[0];
            }
            return $result;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    public static function isDocumentNumberExists ($document_number)
    {
        $p = Patient::where('document_number', '=', $document_number)->get()->count();
        return (($p == 0));
    }
    
    public static function isClinicalNumberHistoryExists ($clinical_history_number)
    {
        try 
        {
            $nn = PatientNN::where('clinical_history_number', '=', $clinical_history_number)->get()->count();
            $p = Patient::where('clinical_history_number', '=', $clinical_history_number)->get()->count();
            return  (($p == 0)&&($nn == 0));
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    public static function createPatient($patient)
    {
        if (Patient::isClinicalNumberHistoryExists($patient->clinical_history_number))
        {
            if (Patient::isDocumentNumberExists ($patient->document_number))
            {
                $answer = Patient::create($patient->all());
                return [
                    'message' => 'se ha creado exitosamente',
                    'http_status' => 200,
                ];
            }
            else
            {
                return [
                    'message' => 'El número de documento está en uso',
                    'http_status' => 422,
                ];
            }
        }
        else
        {
            return [
                'message' => 'El número de historia clínica está en uso',
                'http_status' => 422,
            ];
        }
    }

}
