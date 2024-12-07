<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'favorites';

	protected $casts = [
		'user_id' => 'int',
		'package_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'package_id'
	];

	public function Package()
	{
		return $this->belongsTo(Package::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
