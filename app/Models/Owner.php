<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
	use HasFactory, SoftDeletes;
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
