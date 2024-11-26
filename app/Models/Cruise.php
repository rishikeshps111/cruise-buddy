<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cruise extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'cruises';

	protected $casts = [
		'owner_id' => 'int',
		'cruise_type_id' => 'int',
		'location_id' => 'int',
		'beds' => 'int',
		'rooms' => 'int',
		'max_capacity' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'owner_id',
		'cruise_type_id',
		'location_id',
		'rooms',
		'beds',
		'max_capacity',
		'description',
		'is_active'
	];

	public function cruiseType()
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

	public function cruisesImages()
	{
		return $this->hasMany(CruisesImage::class);
	}

	public function packages(): HasMany
	{
		return $this->hasMany(Package::class);
	}

	public function ratings(): HasMany
	{
		return $this->hasMany(Rating::class);
	}
	public function favorites(): HasMany
	{
		return $this->hasMany(Favorite::class);
	}
}
