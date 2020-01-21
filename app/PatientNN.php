<?php

namespace App;
use DB;
use App\Configuration;
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

    public static function getAllPagination ($number)
    {
        try 
        {
            $p = PatientNN::orderBy('clinical_history_number', 'DESC')->paginate($number);
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
            $p = PatientNN::where('clinical_history_number', 'LIKE', "%$search%")
                ->orderBy('clinical_history_number', 'DESC')
                ->paginate($number);
            $answer = Configuration::generatePagination($p);
            return $answer;
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}
