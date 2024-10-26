<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cruise extends Model
{
	use SoftDeletes;
	protected $table = 'cruises';

	protected $casts = [
		'owner_id' => 'int',
		'cruise_type_id' => 'int',
		'location_id' => 'int',
		'rooms' => 'int',
		'max_capacity' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'owner_id',
		'cruise_type_id',
		'location_id',
		'rooms',
		'max_capacity',
		'description',
		'is_active'
	];

	public function cruise_type()
	{
		return $this->belongsTo(CruiseType::class);
	}

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function owner()
	{
		return $this->belongsTo(Owner::class);
	}

	public function cruises_images()
	{
		return $this->hasMany(CruisesImage::class);
	}
}
