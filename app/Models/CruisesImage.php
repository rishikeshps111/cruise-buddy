<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CruisesImage extends Model
{
	use SoftDeletes;
	protected $table = 'cruises_images';

	protected $casts = [
		'cruise_id' => 'int'
	];

	protected $fillable = [
		'cruise_id',
		'cruise_img',
		'alt'
	];

	public function cruise()
	{
		return $this->belongsTo(Cruise::class);
	}
}
