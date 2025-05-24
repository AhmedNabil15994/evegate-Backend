<?php

namespace Modules\Apps\Providers;

use File;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $apiModule       = '\Modules\Apps\Http\Controllers\Api';
    protected $frontendModule  = '\Modules\Apps\Http\Controllers\Frontend';
    protected $dashboardModule = '\Modules\Apps\Http\Controllers\Dashboard';
    protected $dashboardVendordModule = '\Modules\Apps\Http\Controllers\Vendor';

    // public function map()
    // {
    //     $this->mapApiRoutes();
    //     $this->mapWebRoutes();
    //     $this->mapDashboardRoutes();
    //     // $this->mapDashboardVendorRoutes();
    // }

    protected function mapDashboardRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize')
        ->prefix(LaravelLocalization::setLocale().'/dashboard')
        ->namespace($this->dashboardModule)->group(module_path('Apps', 'Routes/dashboard/routes.php'));
    }

    protected function mapDashboardVendorRoutes()
    {
        Route::middleware('web' , 'localizationRedirect' , 'localeSessionRedirect', 'localeViewPath' , 'localize')
        ->prefix(LaravelLocalization::setLocale().'/vendor')
        ->namespace($this->dashboardVendordModule)->group(module_path('Apps', 'Routes/vendor/routes.php'));
    }


    protected function mapWebRoutes()
    {
        Route::middleware('web', 'localizationRedirect', 'localeSessionRedirect', 'localeViewPath', 'localize')
        ->prefix(LaravelLocalization::setLocale())
        ->namespace($this->frontendModule)->group(module_path('Apps', 'Routes/frontend/routes.php'));
    }

    protected function mapApiRoutes()
    {
        Route::group(['prefix'=>'api' ,'middleware' => ['api'] , 'namespace' => $this->apiModule], module_path('Apps', 'Routes/api/routes.php'));
    }
}
