<?php

namespace App;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Configuration extends Model
{
    use Notifiable;
    protected $table = 'configurations';
    public $timestamps = false;
    protected $fillable = [
         'value'
    ];

    public static function getCustomConfig () 
    {
        $all_config = Configuration::all();
        $custom_config = array();
        foreach ($all_config as $one_config) {
            $aux = array();
            $aux[$one_config->name] = $one_config->value;
            $aux['descrip'] = $one_config->description;
            $custom_config[$one_config->name] = $aux;
        }
        return $custom_config;
    }

    public static function updateConfig (Request $request) 
    {
        Configuration::where('name', '=', 'title_system')->update(array('value' => $request->title_system['title_system']));
        Configuration::where('name', '=', 'title_nav')->update(array('value' => $request->title_nav['title_nav']));
        Configuration::where('name', '=', 'pagination')->update(array('value' => $request->pagination['pagination']));
        Configuration::where('name', '=', 'email')->update(array('value' => $request->email['email']));
        Configuration::where('name', '=', 'description')->update(array('value' => $request->description['description']));
        //Configuration::where('name', '=', 'enable')->update(array('value' => $request->enable['enable']));
    }
}
