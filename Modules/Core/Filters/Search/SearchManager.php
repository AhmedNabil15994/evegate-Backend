<?php

namespace Modules\Core\Filters\Search;

use Illuminate\Database\Eloquent\Builder;

trait SearchManager
{
    public function scopeSearch(Builder $query, array $fields, string $query_string, $operator = 'LIKE')
    {
        foreach ($fields as $index => $field) {
            if ($index == 0) {
                $query->where($field, $operator, "%$query_string%");
            } else {
                $query->orWhere($field, $operator, "%$query_string%");
            }
        }

        return $query;
    }
}
