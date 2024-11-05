<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}
