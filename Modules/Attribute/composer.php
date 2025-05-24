<?php
view()->composer([
    "category::dashboard.categories.create", 
    "category::dashboard.categories.edit"
], \Modules\Attribute\ViewComposers\Dashboard\AttributeComposer::class);
