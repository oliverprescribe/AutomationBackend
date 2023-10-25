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
 * Class Organization
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Department[] $departments
 *
 * @package App\Models
 */
class Organization extends Model
{
	use SoftDeletes;
	protected $table = 'organizations';

	protected $fillable = [
		'name',
		'description'
	];

	public function departments()
	{
		return $this->hasMany(Department::class);
	}
}
