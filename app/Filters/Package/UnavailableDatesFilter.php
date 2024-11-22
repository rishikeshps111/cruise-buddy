<?php

namespace App\Filters\Package;

use Carbon\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UnavailableDatesFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $startDate = Carbon::parse($value['start'])->startOfDay();
        $endDate = isset($value['end']) ? Carbon::parse($value['end'])->endOfDay() : Carbon::parse($value['start'])->endOfDay();
        $query->whereDoesntHave('unavailableDates', function ($query) use ($startDate, $endDate) {
            $query->whereNot('fulfillment_status', 'cancelled')
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                });
        });
    }
}
