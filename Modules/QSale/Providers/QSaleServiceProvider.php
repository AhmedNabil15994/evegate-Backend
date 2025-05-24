<?php

namespace Modules\QSale\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\QSale\Entities\UserCoin;
use Modules\QSale\Enum\SubscriptionType;
use Illuminate\Database\Eloquent\Factory;
use Modules\QSale\Console\CheckExpiredAds;
use Modules\QSale\Console\CheckPublishAds;
use Modules\QSale\Console\RemoveExpiredAdsAdditionsCommand;
use Modules\QSale\Observers\UserCoinObserver;

class QSaleServiceProvider extends ServiceProvider
{
    protected $mapPaymentGetWay = [
        "knet" => \Modules\Core\Packages\Payment\KnetPaymentService::class,
        "my_fatoorah" => \Modules\Core\Packages\Payment\MyFatoorahPaymentService::class,
        "tap" => \Modules\Core\Packages\Payment\TapPaymentService::class,
    ];
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
        $this->loadMigrationsFrom(module_path('QSale', 'Database/Migrations'));
        $this->registerCommand();
        \Illuminate\Database\Eloquent\Relations\Relation::morphMap([
            SubscriptionType::USER_PACKAGE   => \Modules\QSale\Entities\UserPackage::class,
            SubscriptionType::PACKAGE        => \Modules\QSale\Entities\Package::class,
        ]);

        UserCoin::observe(UserCoinObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->registerPaymentService();
    }

    public function registerPaymentService()
    {
        $this->app->singleton(
            \Modules\Core\Packages\Payment\Contract\PaymentInterface::class,
            function ($app) {
                $class =   $this->mapPaymentGetWay["knet"];
                if (isset($this->mapPaymentGetWay[config("services.payment.default")])) {
                    $class =   $this->mapPaymentGetWay[config("services.payment.default")];
                }

                return  new $class;
            }
        );
    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('QSale', 'Config/config.php') => config_path('qsale.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('QSale', 'Config/config.php'),
            'qsale'
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerCommand()
    {
        $this->commands([
            CheckExpiredAds::class,
            CheckPublishAds::class,
            RemoveExpiredAdsAdditionsCommand::class,
        ]);
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/qsale');

        $sourcePath = module_path('QSale', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/qsale';
        }, \Config::get('view.paths')), [$sourcePath]), 'qsale');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/qsale');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'qsale');
        } else {
            $this->loadTranslationsFrom(module_path('QSale', 'Resources/lang'), 'qsale');
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
            app(Factory::class)->load(module_path('QSale', 'Database/factories'));
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
