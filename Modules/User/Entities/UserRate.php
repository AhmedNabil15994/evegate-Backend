<?php

namespace Modules\User\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;

class UserRate extends Model
{
    use ClearsResponseCache;
    use UsesUuid;
    protected $guarded = ["id"];
}
