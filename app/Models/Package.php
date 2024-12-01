<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'packages';

	protected $casts = [
		'cruise_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'cruise_id',
		'name',
		'description',
		'is_active'
	];

	// relationship
	public function cruise()
	{
		return $this->belongsTo(Cruise::class);
	}

	public function itineraries()
	{
		return $this->hasMany(Itinerary::class);
	}

	public function food()
	{
		return $this->belongsToMany(Food::class, 'package_foods')
			->withPivot(['id', 'dining_time'])
			->orderByRaw("
				CASE 
					WHEN dining_time = 'breakfast' THEN 1
					WHEN dining_time = 'lunch' THEN 2
					WHEN dining_time = 'snacks' THEN 3
					WHEN dining_time = 'dinner' THEN 4
					WHEN dining_time = 'all' THEN 5
					ELSE 6
					END
			");
	}

	public function amenities()
	{
		return $this->belongsToMany(Amenity::class, 'package_amenities')
			->withPivot('id');
	}

	public function bookingTypes()
	{
		return $this->belongsToMany(BookingType::class, 'package_booking_types')
			->withPivot([
				'id',
				'price',
				'price_per_day',
				'compare_price',
				'min_amount_to_pay',
				'price_per_person',
				'price_per_bed'
			])
			->orderBy('price');
	}

	public function packageBookingTypes()
	{
		return $this->hasMany(PackageBookingType::class);
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}
	public function unavailableDates()
	{
		return $this->hasMany(Booking::class)
			->where('start_date', '>=', Carbon::today())
			->whereNotIn('fulfillment_status', ['cancelled', 'payment_failed', 'blocked_by_owner']);
	}
	public function packageImages()
	{
		return $this->hasMany(PackageImage::class);
	}
}
