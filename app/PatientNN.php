<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PatientNN extends Model
{
    protected $table = 'patientsNN';
    public $timestamps = false;
    protected $fillable = [
        'clinical_history_number', 
        'created'
    ];

    public static function createPatientNN ($chn)
    {
        DB::table('patientsNN')->insert([
            'clinical_history_number' => $chn,
            'created' => date("Y-m-d"),
        ]);
    }
}
