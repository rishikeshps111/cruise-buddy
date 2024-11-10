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

	public function cruise()
	{
		return $this->belongsTo(Cruise::class);
	}

	public function itineraries()
	{
		return $this->hasOne(Itinerary::class);
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

	public function amenity()
	{
		return $this->belongsToMany(Amenity::class, 'package_amenities')
			->withPivot('id');
	}

	public function package_images()
	{
		return $this->hasMany(PackageImage::class);
	}
}
