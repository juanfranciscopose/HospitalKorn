<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
}
