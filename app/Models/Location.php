<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'locations';

	protected $fillable = [
		'name',
		'district',
		'state',
		'country',
		'map_url',
		'thumbnail'
	];

	public function cruises()
	{
		return $this->hasMany(Cruise::class);
	}

	public function thumbnail(): Attribute
	{
		return Attribute::make(
			get: function (?string $value) {
				if (filter_var($value, FILTER_VALIDATE_URL)) {
					return $value;
				}
				return url("/storage/$value");
			}
		);
	}
}
