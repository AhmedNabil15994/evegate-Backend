<?php

foreach (["coupons.php", "payments.php", "packages.php", "addations.php", "ads.php", "ad_type.php","coins.php", "republished_packages.php"] as  $value) {
    require_once(module_path('QSale', 'Routes/dashboard/' . $value));
}
