<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFood extends Model
{
	protected $table = 'package_foods';
	public $timestamps = false;

	protected $casts = [
		'package_id' => 'int',
		'food_id' => 'int'
	];

	protected $fillable = [
		'package_id',
		'food_id'
	];

	public function food()
	{
		return $this->belongsTo(Food::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
}
