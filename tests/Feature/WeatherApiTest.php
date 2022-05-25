<?php

namespace Tests\Feature;

use App\Models\WeatherData;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class WeatherApiTest extends TestCase
{

    /***
     * check if api provide response
    */

    public function test_api_success()
    {
        $city = 'London';
        $url = 'https://api.openweathermap.org/data/2.5/weather';
        $params = array('q' => $city, 'appid'=> env('WEATHER_API_KEY') );
        $response = Http::get($url, $params);
        $this->assertEquals(200, $response->status());

    }

    /***
     * check if api response without city
    */

    public function test_api_fail_without_city()
    {
        $city = '';
        $url = 'https://api.openweathermap.org/data/2.5/weather';
        $params = array('q' => $city, 'appid'=> env('WEATHER_API_KEY') );
        $response = Http::get($url, $params);
        $this->assertEquals(400, $response->status());

    }
     /***
     * check if api response without key
    */

    public function test_api_fail_without_key()
    {
        $city = '';
        $url = 'https://api.openweathermap.org/data/2.5/weather';
        $params = array('q' => $city, 'appid'=> '' );
        $response = Http::get($url, $params);
        //$response->assertStatus($response->status());
        $this->assertEquals(401, $response->status());

    }

    /**
     * test weather api data from db.
     *
     * @return void
     */
    public function testGetWeatherDataApiSuccess()
    {

        $response = $this->call('GET', '/api/weather-info', ['date' => '']);

        $this->assertEquals(200, $response->status());
    }

    /**
     * test weather api data from db having no data if date not found.
     *
     * @return void
     */
    public function testGetWeatherDataApiNoData()
    {

        $response = $this->call('GET', '/api/weather-info', ['date' => '23-05-2022']);

        $this->assertEquals(204, $response->status());
    }

 /**
     * test weather api data from db having no data if date not found.
     *
     * @return void
     */
    public function testCreateWeatherDataApi()
    {

        $this->withoutExceptionHandling();
        $result = WeatherData::create([
            "location_name" => "New York",
            "lat" => 40.7143,
            "lon" => 40.7143,
            "weather_main" => "Clouds",
            "weather_description" => "broken clouds",
            "weather_id" => 5128581,
            "temp" => 286.05,
            "feels_like" => 285.25,
            "temp_min" => 282.73,
            "temp_max" => 287.59,
            "pressure" => 1027,
            "humidity" => 71,
            "visibility" => 10000,
            "wind_speed" => 2.68,
            "wind_deg" => 97,
            "datetime" => '1653460162',
            "sunrise" => '1653471065',
            "sunset" => '1653524111',
        ]) ; // create a task and store the id in the $task_id variable


        $response = $this->call('GET', '/api/weather-info/'.$result->id );
        $response->assertJson([
            'response'=> true,

        ], true); // ensure that the JSON response recieved contains the message specified
        $response->assertStatus(200);
    }


}
