<?php

namespace App\Filters\Cruise;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class PriceRangeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $min = $value['min'] ?? null;
        $max = $value['max'] ?? null;
        $query->with('packages', function ($query) use ($min, $max) {
            $query->whereHas('bookingTypes', function ($q) use ($min, $max) {
                if ($min !== null) {
                    $q->where('package_booking_types.price', '>=', $min);
                }
                if ($max !== null) {
                    $q->where('package_booking_types.price', '<=', $max);
                }
            });
        });
    }
}
