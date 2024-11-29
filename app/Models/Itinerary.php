<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'itineraries';

	protected $casts = [
		'package_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'package_id',
		'title',
		'time',
		'description',
		'is_active'
	];

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
}
