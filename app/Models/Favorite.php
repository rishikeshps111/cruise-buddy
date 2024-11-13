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
		'cruise_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'cruise_id'
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
