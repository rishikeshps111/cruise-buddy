<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
	use SoftDeletes;
	protected $table = 'locations';

	protected $fillable = [
		'location',
		'district',
		'state',
		'country',
		'map_url'
	];

	public function cruises()
	{
		return $this->hasMany(Cruise::class);
	}
}
