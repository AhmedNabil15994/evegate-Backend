<?php

namespace Modules\DeviceToken\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use UsesUuid;
    protected $fillable = ['platform','user_id','device_token','lang'];
}
