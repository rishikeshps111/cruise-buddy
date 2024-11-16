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
				'price_per_day',
				'compare_price',
				'min_amount_to_pay',
				'price_per_person',
				'price_per_bed',
				'deleted_at'
			)
			->withTimestamps();
	}
}
