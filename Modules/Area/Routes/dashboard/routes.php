<?php
foreach (["cities.php","countries.php", "states.php"] as  $value) {
    require_once(module_path('Area', 'Routes/dashboard/'.$value));
}
