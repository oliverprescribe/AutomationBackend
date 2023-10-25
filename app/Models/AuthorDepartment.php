<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorDepartment
 * 
 * @property int $id
 * @property int $author_id
 * @property int $department_id
 * @property Carbon|null $sr_integrated
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $rsdk_reporting_group
 * @property string|null $rsdk_username
 * 
 * @property Author $author
 * @property Department $department
 *
 * @package App\Models
 */
class AuthorDepartment extends Model
{
	protected $table = 'author_department';

	protected $casts = [
		'author_id' => 'int',
		'department_id' => 'int',
		'sr_integrated' => 'datetime'
	];

	protected $fillable = [
		'author_id',
		'department_id',
		'sr_integrated',
		'rsdk_reporting_group',
		'rsdk_username'
	];

	public function author()
	{
		return $this->belongsTo(Author::class);
	}

	public function department()
	{
		return $this->belongsTo(Department::class);
	}
}
