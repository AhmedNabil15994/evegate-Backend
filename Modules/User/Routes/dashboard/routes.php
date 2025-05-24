<?php
foreach (["admins.php","users.php","companies.php", "technicals.php"] as  $value) {
    require_once(module_path('User', 'Routes/dashboard/'.$value));
}
