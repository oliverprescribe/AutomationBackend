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
 * Class Group
 * 
 * @property int $id
 * @property string $name
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Announcement[] $announcements
 * @property Collection|Department[] $departments
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Group extends Model
{
	use SoftDeletes;
	protected $table = 'groups';

	protected $fillable = [
		'name',
		'type'
	];

	public function announcements()
	{
		return $this->belongsToMany(Announcement::class, 'announcement_groups')
					->withPivot('id')
					->withTimestamps();
	}

	public function departments()
	{
		return $this->belongsToMany(Department::class, 'group_department')
					->withPivot('id', 'department_assigned')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(User::class)
					->withPivot('id', 'suspended_start', 'suspended_end')
					->withTimestamps();
	}
}
