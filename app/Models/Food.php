<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'food';

	protected $casts = [
		'is_veg' => 'bool'
	];

	protected $fillable = [
		'title',
		'description',
		'image',
		'is_veg'
	];

	public function packages()
	{
		return $this->belongsToMany(Package::class, 'package_foods')
			->withPivot(['id', 'dining_time'])
			->orderByRaw("
				CASE 
					WHEN dining_time = 'breakfast' THEN 1
					WHEN dining_time = 'lunch' THEN 2
					WHEN dining_time = 'snacks' THEN 3
					WHEN dining_time = 'dinner' THEN 4
					WHEN dining_time = 'all' THEN 5
					ELSE 4
				END
			");
	}

	// mutator
	public function image(): Attribute
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
