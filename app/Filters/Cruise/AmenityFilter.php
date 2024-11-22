<?php

namespace App\Filters\Cruise;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AmenityFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->with('packages', function ($query) use ($value) {
            $query->whereHas('amenity', function ($q) use ($value) {
                $q->where('name', $value);
            });
        });
    }
}
