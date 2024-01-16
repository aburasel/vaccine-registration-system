<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('send:email')
            ->days(
                [
                    Schedule::SUNDAY,
                    Schedule::MONDAY,
                    Schedule::TUESDAY,
                    Schedule::WEDNESDAY,
                ]
            )->timezone('Asia/Dhaka')
            ->at('21:00');

        $schedule->command('queue:retry all')->everyMinute();
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
//G:/xampp/php
