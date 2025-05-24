<?php

view()->composer(
    ['vendor::dashboard.vendors.*', "post::dashboard.*", "user::dashboard.teachers.*" ],
    \Modules\Section\ViewComposers\Dashboard\SectionComposer::class
);
