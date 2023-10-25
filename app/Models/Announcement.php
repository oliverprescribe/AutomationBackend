<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Announcement
 * 
 * @property int $id
 * @property string $subject
 * @property string $message
 * @property Carbon $start_on
 * @property Carbon $deleted_on
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Group[] $groups
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Announcement extends Model
{
	use SoftDeletes;
	protected $table = 'announcements';

	protected $casts = [
		'start_on' => 'datetime',
		'deleted_on' => 'datetime'
	];

	protected $fillable = [
		'subject',
		'message',
		'start_on',
		'deleted_on'
	];

	public function groups()
	{
		return $this->belongsToMany(Group::class, 'announcement_groups')
					->withPivot('id')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'announcement_users')
					->withPivot('id', 'is_acknowledged', 'read_at')
					->withTimestamps();
	}
}
