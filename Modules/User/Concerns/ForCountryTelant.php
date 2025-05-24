<?php
namespace Modules\User\Concerns;

use Modules\User\Scopes\CountryCodeScope;

trait ForCountryTelant {

     /**
     * The 'boot' method of the model.
     *
     * @return void
     */
    protected static function bootForCountryTelant()
    {
      
        static::addGlobalScope(
            new CountryCodeScope()
        );
    }
}