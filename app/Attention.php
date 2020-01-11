<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Configuration;

class Attention extends Model
{
    use Notifiable;
    protected $table = 'attentions';
    public $timestamps = false;
    protected $fillable = [
        'patient_id',
        'diagnostic',
        'date',
        'reason',
        'derivation',
        'observation',
        'articulation',
        'internment',
        'pharmacotherapy',
        'accompaniment'
    ];
    
    public static function reportReasonCount ()
    {
        $reason = array(
            'guard_control' => Attention::where('reason', '=', 'Control de guardia')->count(),
            'prescription' => Attention::where('reason', '=', 'Receta médica')->count(),
            'consultation' => Attention::where('reason', '=', 'Consulta')->count(),
            'suicide_attempt' => Attention::where('reason', '=', 'Intento de suicidio')->count(),
            'interconsultation' => Attention::where('reason', '=', 'Interconsulta')->count(),
            'other' => Attention::where('reason', '=', 'Otras')->count(),
        );
        return $reason;
    }

    public static function deleteAttention ($id)
    {
        try 
        {
            Attention::where('id', '=', $id)->delete();
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }
    }
    
    public static function getAllPagination ($number)
    {
        try 
        {
            $a =  Attention::select('patients.clinical_history_number as patient_chn', 
                'patients.surname as patient_surname', 'patients.name as patient_name' ,
                'patients.document_number as patient_document_number', 'attentions.id','attentions.patient_id',
                'attentions.reason', 'attentions.diagnostic', 'attentions.derivation', 'attentions.observation', 
                'attentions.articulation', 'attentions.internment', 'attentions.pharmacotherapy', 'attentions.date',
                'attentions.accompaniment')->join('patients', 'attentions.patient_id', '=', 'patients.id')
                ->orderBy('attentions.id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($a);
        return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }
    }

    public static function searchPagination ($search, $number)
    {
        try 
        {
            $a = Attention::select('patients.clinical_history_number as patient_chn', 
                'patients.surname as patient_surname', 'patients.name as patient_name' ,
                'patients.document_number as patient_document_number', 'attentions.id','attentions.patient_id',
                'attentions.reason', 'attentions.diagnostic', 'attentions.derivation', 'attentions.observation', 
                'attentions.articulation', 'attentions.internment', 'attentions.pharmacotherapy', 'attentions.date',
                'attentions.accompaniment')->join('patients', 'attentions.patient_id', '=', 'patients.id')
                ->where('reason', 'LIKE', "%$search%")
                ->orWhere('diagnostic', 'LIKE', "%$search%")
                ->orWhere('patients.surname', 'LIKE', "%$search%")
                ->orWhere('patients.clinical_history_number', 'LIKE', "%$search%")
                ->orderBy('attentions.id', 'desc')
                ->paginate($number);
            $answer = Configuration::generatePagination($a);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessaje());
        }
    }
}
