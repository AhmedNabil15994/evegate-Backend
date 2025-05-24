<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Packages\Setting\SettingManager;
use Modules\Core\Packages\Setting\SettingJsonService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
        if (config("services.allow_bugsnag")) {
            $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
            $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
        }
     
        $this->app->singleton(SettingManager::class, SettingJsonService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('production')) {
            app('url')->forceScheme('https');
        }
    }
}
