<?php

namespace App\Providers;

use App\Console\Commands\EndMeetingReminder;
use App\Console\Commands\meetingAttendReminder;
use App\Console\Commands\sendMeetingReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {
        $schedule->command(sendMeetingReminder::class)->everyMinute();
        $schedule->command(meetingAttendReminder::class)->everyMinute();
        $schedule->command(EndMeetingReminder::class)->everyMinute();
    }
}
