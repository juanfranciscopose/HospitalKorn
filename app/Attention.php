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
}
