<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'ratings';

	protected $casts = [
		'user_id' => 'int',
		'cruise_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'user_id',
		'cruise_id',
		'rating',
		'description'
	];

	public function cruise()
	{
		return $this->belongsTo(Cruise::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
