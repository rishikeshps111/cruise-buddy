<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
	use SoftDeletes;
	protected $table = 'packages';

	protected $casts = [
		'owner_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'owner_id',
		'name',
		'description',
		'is_active'
	];

	public function owner()
	{
		return $this->belongsTo(Owner::class);
	}

	public function itineraries()
	{
		return $this->hasMany(Itinerary::class);
	}

	public function package_amenities()
	{
		return $this->hasMany(PackageAmenity::class);
	}

	public function food()
	{
		return $this->belongsToMany(Food::class, 'package_foods')
					->withPivot('id');
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
