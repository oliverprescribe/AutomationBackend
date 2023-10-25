<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $id
 * @property int $user_id
 * @property int $letter_id
 * @property int $owner_id
 * @property string $owner_type
 * @property string $remarks
 * @property Carbon|null $read_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notifications';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'owner_id' => 'int',
		'read_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'owner_id',
		'owner_type',
		'remarks',
		'read_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
