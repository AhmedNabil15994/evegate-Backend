<?php

namespace Modules\Setting\ViewComposers\Dashboard;

use Illuminate\View\View;
use PragmaRX\Countries\Package\Countries;

class CountriesCodeComposer
{
    public function compose(View $view)
    {
        $phoneCodes = supportedPhoneCodes();

        

        $view->with('phoneCodes' , $phoneCodes);
    }
}
