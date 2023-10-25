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
 * Class Department
 *
 * @property int $id
 * @property int $client_id
 * @property int|null $organization_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Client $client
 * @property Organization|null $organization
 * @property Collection|Author[] $authors
 * @property Collection|Group[] $groups
 * @property Collection|Letter[] $letters
 *
 * @package App\Models
 */
class Department extends Model
{
	use SoftDeletes;
	protected $table = 'departments';

	protected $casts = [
		'client_id' => 'int',
		'organization_id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'organization_id',
		'name'
	];

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

	public function authors()
	{
		return $this->belongsToMany(Author::class)
					->withPivot('id', 'sr_integrated', 'rsdk_reporting_group', 'rsdk_username')
					->withTimestamps();
	}

	public function groups()
	{
		return $this->belongsToMany(Group::class, 'group_department')
					->withPivot('id', 'department_assigned')
					->withTimestamps();
	}

	public function letters()
	{
		return $this->hasMany(Letter::class);
	}
}
