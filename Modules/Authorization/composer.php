<?php

view()->composer(['user::dashboard.admins.index'], \Modules\Authorization\ViewComposers\Dashboard\AdminRolesComposer::class);


view()->composer([
  'worker::dashboard.workers.*',
], \Modules\Authorization\ViewComposers\Dashboard\WorkerRolesComposer::class);
