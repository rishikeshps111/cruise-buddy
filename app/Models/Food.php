<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
	use SoftDeletes;
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
					->withPivot('id');
	}
}
