<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'payments';

	protected $casts = [
		'booking_id' => 'int',
		'amount' => 'float',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'booking_id',
		'payment_id',
		'amount',
		'currency',
		'status',
		'order_id',
		'payment_method',
		'bank',
		'email',
		'contact',
		'notes',
		'is_active'
	];

	public function booking()
	{
		return $this->belongsTo(Booking::class);
	}
}
