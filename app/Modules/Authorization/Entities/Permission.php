<?php

namespace App\Modules\Authorization\Entities;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = ["id"];
}
