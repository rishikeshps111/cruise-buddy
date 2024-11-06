<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
	use SoftDeletes;
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
}
