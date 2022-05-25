<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['location_name','lat','lon','weather_main','weather_description','weather_id','temp','feels_like',
                            'temp_min','temp_max','pressure','humidity','visibility','wind_speed','wind_deg','datetime','sunrise','sunset'];

    /**
     * Update date format
     *
     * @param  string  $value
     * @return void
     */
    public function setDatetimeAttribute($value)
    {
        $this->attributes['datetime'] = date('Y-m-d H:i:s',$value);
    }

    /**
     * Update date format
     *
     * @param  string  $value
     * @return void
     */
    public function setSunriseAttribute($value)
    {
        $this->attributes['sunrise'] = date('Y-m-d H:i:s',$value);
    }

    /**
     * Update date format
     *
     * @param  string  $value
     * @return void
     */
    public function setSunsetAttribute($value)
    {
        $this->attributes['sunset'] = date('Y-m-d H:i:s',$value);
    }


}
