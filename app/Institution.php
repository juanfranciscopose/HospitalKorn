<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Institution extends Model
{
    use Notifiable;
    protected $table = 'institutions';
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden =[];
    protected $fillable = [
        'name', 'director', 'telephone', 'address','lat', 'long', 'sanitary_region_id'
    ];

}
