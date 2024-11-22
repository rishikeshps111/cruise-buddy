<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CruiseType extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'cruise_types';

	protected $fillable = [
		'model_name',
		'type',
		'image'
	];

	public function cruises()
	{
		return $this->hasMany(Cruise::class);
	}

	public function modelName(): Attribute
	{
		return Attribute::make(
			get: fn(string $value) => ucwords(str_replace('_', ' ', $value)),
		);
	}
	public function type(): Attribute
	{
		return Attribute::make(
			get: fn(string $value) => ucwords(str_replace('_', ' ', $value)),
		);
	}
	public function image(): Attribute
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
