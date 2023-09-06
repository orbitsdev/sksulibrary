<?php

namespace App\Console;

use App\Models\DayLogout;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

            // $schedule->call(function () {
            //     DayLogout::where('status', 'not-yet-logout')->uppdate(['status' => 'did-not-logout']);
            // })->everyMinute();
            $schedule->call(function () {
                DayLogout::where('status', 'Not Logout')->update(['status' => 'Did Not Logout']);
            })->daily()->at('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
