<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageImage extends Model
{
	use SoftDeletes;
	protected $table = 'package_images';

	protected $casts = [
		'package_id' => 'int'
	];

	protected $fillable = [
		'package_id',
		'package_img',
		'alt'
	];

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
}
