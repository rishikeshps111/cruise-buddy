<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageAmenity extends Model
{
	protected $table = 'package_amenities';
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'amenity_id' => 'int'
	];

	protected $fillable = [
		'package_id',
		'amenity_id'
	];

	public function amenity()
	{
		return $this->belongsTo(Amenity::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
}
