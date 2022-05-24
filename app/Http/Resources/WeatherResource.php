<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $coord = $this['coord'];
        $weather = $this['weather'];
        $main = $this['main'];
        $visibility = $this['visibility'];
        $wind = $this['wind'];
        $sys = $this['sys'];
        $id = $this['id'];
        $name = $this['name'];
        $dt = $this['dt'];


        $data=array();

         $data['location_name']=(isset($name)?$name:null);
         $data['lat']=(isset($coord['lat'])?$coord['lat']:null);
         $data['lon']=(isset($coord['lat'])?$coord['lat']:null);
         $data['weather_main']=(isset($weather[0]['main'])?$weather[0]['main']:null);
         $data['weather_description']=(isset($weather[0]['description'])?$weather[0]['description']:null);
         $data['weather_id']=(isset($id)?$id:null);
         $data['temp']=(isset($main['temp'])?$main['temp']:null);
         $data['feels_like']=(isset($main['feels_like'])?$main['feels_like']:null);
         $data['temp_min']=(isset($main['temp_min'])?$main['temp_min']:null);
         $data['temp_max']=(isset($main['temp_max'])?$main['temp_max']:null);
         $data['pressure']=(isset($main['pressure'])?$main['pressure']:null);
         $data['humidity']=(isset($main['humidity'])?$main['humidity']:null);
         $data['visibility']=(isset($visibility)?$visibility:null);
         $data['wind_speed']  = (isset($wind['speed'])?$wind['speed']:null);
         $data['wind_deg']  = (isset($wind['deg'])?$wind['deg']:null);
         $data['datetime']  = (isset($dt)?$dt:null);
         $data['sunrise']  = (isset($sys['sunrise'])?$sys['sunrise']:null);
         $data['sunset']  = (isset($sys['sunset'])?$sys['sunset']:null);

        return $data;
    }
}
