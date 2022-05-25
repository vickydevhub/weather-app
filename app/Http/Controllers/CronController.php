<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\Http\Resources\WeatherResource;

use Illuminate\Support\Facades\Log;

use App\Jobs\ProcessWeatherData;

class CronController extends Controller
{
    public function index(){
        $cities = array('New York','London','Paris','Berlin','Tokyo');
        foreach($cities as $city)
        {
            $url = 'https://api.openweathermap.org/data/2.5/weather';
            $params = array('q' => $city, 'appid'=> env('WEATHER_API_KEY') );
            $response = Http::get($url, $params);
            if($response->status())
            {
                $data = $response->body();
                $data = json_decode( $data ,true);
                if($data['cod'] == 200)
                {
                    //Transform json data to filterize array
                    $result = json_decode(
                        json_encode(
                            (new WeatherResource($data))
                                ->toResponse(null)
                                ->getData()
                                ->data
                        ),
                    true);
                    //add job to queue
                    ProcessWeatherData::dispatch($result)
                                 ->delay(now()->addMinutes(1));

                }else{
                    Log::channel('weather')->error($data['message']);
                }


            }else{
                Log::channel('weather')->info('There is some error in getting data');

            }
        }


    }
}
