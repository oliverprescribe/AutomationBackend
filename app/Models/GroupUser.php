<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupUser
 * 
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property Carbon|null $suspended_start
 * @property Carbon|null $suspended_end
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Group $group
 * @property User $user
 *
 * @package App\Models
 */
class GroupUser extends Model
{
	protected $table = 'group_user';

	protected $casts = [
		'user_id' => 'int',
		'group_id' => 'int',
		'suspended_start' => 'datetime',
		'suspended_end' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'group_id',
		'suspended_start',
		'suspended_end'
	];

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
