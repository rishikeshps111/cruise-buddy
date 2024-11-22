<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'amenities';

	protected $fillable = [
		'name',
		'icon'
	];

	public function packages()
	{
		return $this->belongsToMany(Package::class, 'package_amenities')
			->withPivot('id');
	}

	public function icon(): Attribute
	{
		return Attribute::make(
			get: function (string $value) {
				if (filter_var($value, FILTER_VALIDATE_URL)) {
					return $value;
				}
				return url("/storage/$value");
			}
		);
	}
}
