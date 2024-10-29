<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CruiseType extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'cruise_types';

	protected $fillable = [
		'model_name',
		'type'
	];

	public function cruises()
	{
		return $this->hasMany(Cruise::class);
	}
}
