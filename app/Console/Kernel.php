<?php

namespace App\Console;

use App\Models\DayLogout;
use App\Models\DayRecord;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        info('Scheduled task started');
        // $schedule->command('inspire')->hourly();
        
        // $schedule->call(function () {
            //     DayLogout::where('status', 'not-yet-logout')->uppdate(['status' => 'did-not-logout']);
            // })->everyMinute();
            
            // $schedule->call(function () {
                //     DayLogout::where('status', 'Not Logout')->update(['status' => 'Logged out']);
                // })->daily()->at('00:00');
                $schedule->call(function () {
                    $dayRecord = DayRecord::latest()->first();
                    if($dayRecord){
                        
                        DayLogout::whereHas('login', function($query) use($dayRecord){
                            $query->where('day_record_id', $dayRecord->id);
                        })->where('status', 'Not Logout')->update(['status' => 'Logged out']);
                        info("Updated  rows");
                    }
                })->everyMinute();
                
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
