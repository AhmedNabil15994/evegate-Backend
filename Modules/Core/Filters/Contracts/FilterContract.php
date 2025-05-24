<?php

namespace Modules\Core\Filters\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterContract
{
    public function apply(Builder $query);
}
