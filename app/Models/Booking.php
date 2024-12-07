<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'bookings';

	protected $casts = [
		'user_id' => 'int',
		'package_id' => 'int',
		'booking_type_id' => 'int',
		'veg_count' => 'int',
		'non_veg_count' => 'int',
		'jain_veg_count' => 'int',
		'total_amount' => 'float',
		'amount_paid' => 'float',
		'balance_amount' => 'float',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'booked_by_user' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'invoice_id',
		'order_id',
		'user_id',
		'package_id',
		'booking_type_id',
		'veg_count',
		'non_veg_count',
		'jain_veg_count',
		'total_amount',
		'amount_paid',
		'balance_amount',
		'customer_note',
		'start_date',
		'end_date',
		'fulfillment_status',
		'booked_by_user',
		'is_active'
	];

	public function bookingType()
	{
		return $this->belongsTo(BookingType::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}
}
