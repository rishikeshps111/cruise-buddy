<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
	use SoftDeletes, HasFactory;
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
