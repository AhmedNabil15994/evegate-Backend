<?php

namespace Modules\DeviceToken\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\DeviceToken\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\DeviceToken\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\DeviceToken\Http\Controllers\Dashboard';


    protected function mapDashboardRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(module_path('DeviceToken', 'Routes/dashboard/routes.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(module_path('DeviceToken', 'Routes/frontend/routes.php'));
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule],module_path('DeviceToken', 'Routes/api/routes.php'));
    }

}
