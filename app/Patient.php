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
}
