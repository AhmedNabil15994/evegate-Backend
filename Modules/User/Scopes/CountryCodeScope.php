<?php
namespace Modules\User\Scopes;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class CountryCodeScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $request = request();
        if(Request::hasMacro('countryCode')){
            $code = $request->countryCode();
            if($code) {

                if (method_exists($model, 'tenantCountryQuery')) {
                    $model->tenantCountryQuery($builder, $code);
                } else {
                    $builder->where("phone_code", '=', $code);
                }

            }
        }


    }
}
