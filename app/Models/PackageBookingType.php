<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBookingType extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'package_booking_types';

	protected $casts = [
		'package_id' => 'int',
		'booking_type_id' => 'int',
		'price' => 'float',
		'price_per_day' => 'float',
		'compare_price' => 'float',
		'min_amount_to_pay' => 'float',
		'price_per_person' => 'float',
		'price_per_bed' => 'float'
	];

	protected $fillable = [
		'package_id',
		'booking_type_id',
		'price',
		'price_per_day',
		'compare_price',
		'min_amount_to_pay',
		'price_per_person',
		'price_per_bed'
	];

	public function bookingType()
	{
		return $this->belongsTo(BookingType::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
	public function priceRule()
	{
		return $this->hasMany(PriceRule::class)->orderByRaw("
            CASE 
                WHEN price_type = 'date' THEN 1
                WHEN price_type = 'custom_range' THEN 2
                WHEN price_type = 'weekends' THEN 3
                ELSE 4
                END
        ");
	}
}
