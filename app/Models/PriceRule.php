<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceRule extends Model
{
    use SoftDeletes, HasFactory;

    protected $casts = [
        'package_booking_type_id' => 'int',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'package_booking_type_id',
        'price_type',
        'price',
        'compare_price',
        'min_amount_to_pay',
        'price_per_person',
        'price_per_bed',
        'start_date',
        'end_date'
    ];

    public function packageBookingType()
    {
        return $this->belongsTo(PackageBookingType::class);
    }
}
