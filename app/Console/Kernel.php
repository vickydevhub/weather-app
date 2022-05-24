<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        foreach (['01:00', '06:00', '13:00', '23:00'] as $time) {
         $schedule->command('weather:cron')->dailyAt($time)
                    ->onSuccess(function () use($time) {
                        Log::channel('weather')->info('Cron job run succesfully at '.$time);
                    })
                    ->onFailure(function () use($time) {
                        Log::channel('weather')->info('Cron job failed at '.$time);
                    });
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
