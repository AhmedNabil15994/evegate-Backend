<?php

view()->composer(
    [
        'user::dashboard.companies.create',
        'user::dashboard.companies.edit',
        "user::dashboard.*",
        "ads::dashboard.ads.*"
     ],
    \Modules\Setting\ViewComposers\Dashboard\CountriesCodeComposer::class
);
