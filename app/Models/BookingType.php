<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingType extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'booking_types';

	protected $fillable = [
		'name',
		'icon'
	];

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

	public function packages()
	{
		return $this->belongsToMany(Package::class, 'package_booking_types')
					->withPivot(
                        'id', 
                        'price', 
                        'compare_price', 
                        'min_amount_to_pay', 
                        'price_per_person', 
                        'price_per_bed', 
                        'deleted_at'
                        )
					->withTimestamps();
	}

	public function priceRules()
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

