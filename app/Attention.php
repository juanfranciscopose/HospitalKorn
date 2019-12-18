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
    public static function getAllAttentionsByIdPatient ($id) 
    {
        if (isset($id))
        {
            $attentions = Attention::where('patient_id', '=', $id)->orderBy('id', 'DESC')->get();
            return $attentions;
        }
        else
        {
            return 'Error en el ID de paciente';
        }
    }
}
