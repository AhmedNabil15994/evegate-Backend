<?php

namespace Modules\Area\Entities;

use Modules\Core\Filters\Filters;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Filters\Search\SearchManager;

class StateTranslation extends Model
{
    use ClearsResponseCache;
    use Filters ;
    use SearchManager;
    protected $fillable = [];
}
