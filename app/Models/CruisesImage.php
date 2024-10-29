<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CruisesImage extends Model
{
	use SoftDeletes, HasFactory;
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
