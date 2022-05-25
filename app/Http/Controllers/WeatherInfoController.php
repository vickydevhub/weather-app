<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherData;

use Illuminate\Support\Facades\Validator;

class WeatherInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new WeatherData();
        //If search for a particular date
        if($request->filled('date')){
            $data=$data->whereDate('datetime',date('Y-m-d',strtotime($request->input('date'))));
        }
        //if search between particular date range
        if($request->filled('start_date') && $request->filled('end_date')){

            $start_date = date('Y-m-d',strtotime($request->input('start_date')));
            $end_date = date('Y-m-d',strtotime($request->input('end_date')));

            $data=$data->whereBetween('datetime',[$start_date,$end_date]);
        }
        $data = $data->get();
        if($data && count($data) > 0){
            return response()
                        ->json(['response'=> true,'data'=>$data], 200)
                        ->header('Content-Type', 'application/json');
        }else{
            return response()
                        ->json(['response'=>false,'data'=>[]], 204)
                        ->header('Content-Type', 'application/json');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_name' => 'required',
            'lat' => 'required',
            'lon'=> 'required',
            'weather_main'=> 'required',
            'weather_description'=> 'required',
            'weather_id'=> 'required',
            'temp'=> 'required',
            'feels_like'=> 'required',
            'temp_min'=> 'required',
            'temp_max'=> 'required',
            'pressure'=> 'required',
            'humidity'=> 'required',
            'visibility'=> 'required',
            'wind_speed'=> 'required',
            'wind_deg'=> 'required',
            'datetime'=> 'required',
            'sunrise'=> 'required',
            'sunset'=> 'required',
         ]);

        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }

        $input = $request->all();

        WeatherData::updateOrCreate(['weather_id' => $input['weather_id']], $input);

        return response()
                        ->json(['response'=> true,'data'=>'Weather information stored successfully'], 200)
                        ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the WeatherData
        $response = WeatherData::find($id);
        return response()
                ->json(['response'=> true,'data'=>$response], 200)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the WeatherData
        $response = WeatherData::find($id);
        return response()
                ->json($response, 200)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = WeatherData::find($id);
        if($data){
            $validator = Validator::make($request->all(), [
                'location_name' => 'required',
                'lat' => 'required',
                'lon'=> 'required',
                'weather_main'=> 'required',
                'weather_description'=> 'required',
                'weather_id'=> 'required',
                'temp'=> 'required',
                'feels_like'=> 'required',
                'temp_min'=> 'required',
                'temp_max'=> 'required',
                'pressure'=> 'required',
                'humidity'=> 'required',
                'visibility'=> 'required',
                'wind_speed'=> 'required',
                'wind_deg'=> 'required',
                'datetime'=> 'required',
                'sunrise'=> 'required',
                'sunset'=> 'required',
             ]);

            if($validator->fails()){
                return response()->json($validator->messages(), 200);
            }

            $input = $request->all();

            $data->fill($input);

            $data->save();

            return response()
                    ->json(['response'=>true,'data'=>['Weather data successfully updated']], 200)
                    ->header('Content-Type', 'application/json');

        }else{
            return response()
                    ->json(['response'=>false,'data'=>[]], 204)
                    ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // get the WeatherData
         $response = WeatherData::find($id);
         if($response){
            $response->delete();
         }
         return response()
                 ->json(['Deleted successfully'], 200)
                 ->header('Content-Type', 'application/json');
    }
}
