<?php

namespace App\Filters\Package;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CruiseTypeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (!is_array($value))
            $value = explode(',', $value);
        $query->whereHas('cruise.cruiseType', function ($query) use ($value) {
            $query->whereIn('type', $value);
        });
    }
}
