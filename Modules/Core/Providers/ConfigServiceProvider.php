<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use PragmaRX\Countries\Package\Countries;
use Modules\Core\Packages\PhoneCodes\PhoneCodesManager;
use Modules\Core\Packages\PhoneCodes\PragmaRXPhoneCodesService;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
            
        $this->registerBind();
       
        $this->setLocalesConfigurations();
    }

    public function boot()
    {
        $this->setSettingConfigurations();
    }

    private function setLocalesConfigurations()
    {
          $defaultLocale = setting('default_locale') ? setting('default_locale') : 'en';
          $locales       = setting('locales')        ? setting('locales') : ['en'];
          $rtlLocales    = setting('rtl_locales')    ? setting('rtl_locales') : ['ar'];

          $this->app->config->set([
            'app.locale'                                    => $defaultLocale,
            'app.fallback_locale'                           => $defaultLocale,
            'laravellocalization.supportedLocales'          => supportedLocales($locales),          'laravellocalization.useAcceptLanguageHeader'   => true,
            'laravellocalization.hideDefaultLocaleInURL'    => false,
            'default_locale'                                => $defaultLocale,
            'rtl_locales'                                   => $rtlLocales,
            'translatable.locales'                          => $locales,
            'translatable.locale'                           => $defaultLocale,
          ]);
    }

    private function setSettingConfigurations()
    {
        $this->app->config->set([
            'app.name'  => setting('app_name',locale()),
        ]);
    }

  

    public function registerBind(){

        $this->app->singleton(PhoneCodesManager::class, PragmaRXPhoneCodesService::class );
    }
}
