<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Cache;

class Config extends Model
{
  //  protected $guard = 'panel';
 //   protected $table = 'configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'key', 'value'
    ];

    public static function setConfigs($inputs)
    {
        foreach ($inputs as $key => $value) {
          //  if($key !== '_token') {
                self::updateOrCreate(['key' => $key], ['value' =>$value?$value:'']);
        //    }
        }
    }

    public static function getConfigs($array) {
        $data = self::whereIn('key', $array)->pluck('value', 'key')->all();
        $output = array_fill_keys($array, "");
        return array_merge($output, $data);
    }

}
