<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupDepartment
 * 
 * @property int $id
 * @property int $department_id
 * @property int $group_id
 * @property string $department_assigned
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Department $department
 * @property Group $group
 *
 * @package App\Models
 */
class GroupDepartment extends Model
{
	protected $table = 'group_department';

	protected $casts = [
		'department_id' => 'int',
		'group_id' => 'int'
	];

	protected $fillable = [
		'department_id',
		'group_id',
		'department_assigned'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function group()
	{
		return $this->belongsTo(Group::class);
	}
}
