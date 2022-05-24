<?php

namespace App\Listeners;

use App\Events\WeatherDataProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWeatherDataNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WeatherDataProcessed  $event
     * @return void
     */
    public function handle(WeatherDataProcessed $event)
    {
        //
    }
}
