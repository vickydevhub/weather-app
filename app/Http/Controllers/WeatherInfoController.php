<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherData;

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
                        ->json($data, 200)
                        ->header('Content-Type', 'application/json');
        }else{
            return response()
                        ->json(['No record found'], 204)
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
        //
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
                ->json($response, 200)
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
        //
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
