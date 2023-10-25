<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPermission
 * 
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Permission $permission
 * @property User $user
 *
 * @package App\Models
 */
class UserPermission extends Model
{
	protected $table = 'user_permission';

	protected $casts = [
		'user_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'permission_id'
	];

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
