<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Support\Carbon;

class DateRangeFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $startDate = Carbon::parse($value['start']);
        $endDate = isset($value['end']) ? Carbon::parse($value['end']) : Carbon::parse($value['start']);

        $query->whereDoesntHave('packages.bookings', function ($query) use ($startDate, $endDate) {

            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereNot('fulfillment_status', 'cancelled')
                    ->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            });
        });
    }
}
