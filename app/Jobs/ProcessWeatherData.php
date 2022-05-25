<?php

namespace App\Jobs;

use App\Events\WeatherDataProcessed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\WeatherData;

use Illuminate\Support\Facades\Log;

class ProcessWeatherData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public function __construct($result)
    {
       $this->data = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $request = $this->data;
            $dattime = date('Y-m-d', strtotime($request['datetime']));
            //$res = WeatherData::updateOrCreate(['weather_id' => $request['weather_id']], $request);
            $res = WeatherData::where('weather_id',$request['weather_id'])
                                ->whereDate('datetime',$dattime)
                                ->first();
            if( $res)
            {
                $res->fill($request);
                $res->save();
            }
            else
            {
                $res = WeatherData::create($request);
            }
            event (new WeatherDataProcessed($res));

        } catch (\Throwable $th) {

            Log::channel('weather')->error($th->getMessage());
        }
    }
}
