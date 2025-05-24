<?php

namespace App\Console;

use App\Console\Commands\CreatePermission;
use App\Console\Commands\CreateSuperAdmin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\QSale\Console\RemoveExpiredAdsAdditionsCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        CreatePermission::class,
        CreateSuperAdmin::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('debugbar:clear')->daily()->at('01:00');
        // $schedule->command('telescope:clear')->daily()->at('01:00');
        $schedule->command('passport:purge')->daily()->at('03:00');

        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');
        if (\App::environment('production') && config("backup.allow")) {
            $schedule->command('backup:clean')->daily()->at('01:00');
            $schedule->command('backup:run')->daily()->at('02:00');
        }
        $schedule->command('activitylog:clean')->daily()->at('01:00');
        $schedule->command('responsecache:clear')->daily()->at('00:01');

        // check ads expired
        $schedule->command('Ads:check-expired')->daily()->at('00:01');
        $schedule->command('Ads:check-publish')->daily()->at('00:01');
        $schedule->command('ads-additions:check-expired')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
