<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnouncementUser
 * 
 * @property int $id
 * @property int $user_id
 * @property int $announcement_id
 * @property Carbon|null $is_acknowledged
 * @property Carbon|null $read_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Announcement $announcement
 * @property User $user
 *
 * @package App\Models
 */
class AnnouncementUser extends Model
{
	protected $table = 'announcement_users';

	protected $casts = [
		'user_id' => 'int',
		'announcement_id' => 'int',
		'is_acknowledged' => 'datetime',
		'read_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'announcement_id',
		'is_acknowledged',
		'read_at'
	];

	public function announcement()
	{
		return $this->belongsTo(Announcement::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
