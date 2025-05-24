<?php

namespace Modules\User\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\User\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\User\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\User\Http\Controllers\Dashboard';
    protected $dashboardVendordModule = '\Modules\User\Http\Controllers\Vendor';

    protected function mapDashboardRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize', 'permission:dashboard_access')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(module_path('User', 'Routes/dashboard/routes.php'));
    }

    protected function mapDashboardVendorRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize',  'permission:worker_access')
        ->prefix(LaravelLocalization::setLocale().'/vendor')
        ->namespace($this->dashboardVendordModule)->group(module_path('User', 'Routes/vendor/routes.php'));
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(module_path('User', 'Routes/frontend/routes.php'));
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule], module_path('User', 'Routes/api/routes.php'));
    }
}
