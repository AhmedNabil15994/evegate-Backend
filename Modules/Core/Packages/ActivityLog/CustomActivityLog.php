<?php

namespace Modules\Core\Packages\ActivityLog;

use Illuminate\Support\Arr;

use Modules\Core\Traits\UsesUuid;
use Spatie\Activitylog\Models\Activity;


class CustomActivityLog  extends  Activity
{
    use UsesUuid;

    public function vendor(): MorphTo
    {
        return $this->morphTo();
    }
}
