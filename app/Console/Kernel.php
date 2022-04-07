<?php

namespace App\Console;

use App\Feed\CreateJobs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->call(function() {
            (new CreateJobs());
        })->everyThreeMinutes()->between('06:00:00', '23:59:59');

        $schedule->call(function() {
            (new CreateJobs());
        })->everyTenMinutes()->between('00:00:00', '05:59:59');
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
