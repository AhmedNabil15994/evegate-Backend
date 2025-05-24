<?php

namespace Modules\ShippingCompany\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ShippingCompanyServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('ShippingCompany', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('ShippingCompany', 'Config/config.php') => config_path('shipping_company.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('ShippingCompany', 'Config/config.php'),
            'shipping_company'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/shipping_company');

        $sourcePath = module_path('ShippingCompany', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/shipping_company';
        }, \Config::get('view.paths')), [$sourcePath]), 'shipping_company');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/shipping_company');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'shipping_company');
        } else {
            $this->loadTranslationsFrom(module_path('ShippingCompany', 'Resources/lang'), 'shipping_company');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('ShippingCompany', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
