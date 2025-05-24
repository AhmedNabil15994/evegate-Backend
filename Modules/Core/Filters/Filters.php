<?php

namespace  Modules\Core\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filters
{
    public function scopeWithFilters(Builder $builder, array $filters)
    {
        foreach ($filters as $filter) {
            $filter->apply($builder);
        }
    }
}
