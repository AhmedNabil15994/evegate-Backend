<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            if (config("telescope.enabled", false)) {
                $schedule->command('telescope:prune --hours=48')->daily();
                $schedule->command('telescope:clear --hours=48')->daily();
            }
        });
    }

    public function register()
    {
    }
}
