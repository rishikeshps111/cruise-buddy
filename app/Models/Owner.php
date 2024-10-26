<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Owner extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'owners';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'proof_type',
		'proof_id',
		'proof_image',
		'additional_phone'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function cruises()
	{
		return $this->hasMany(Cruise::class);
	}
}
