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
 * Class Application
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Client[] $clients
 *
 * @package App\Models
 */
class Application extends Model
{
	use SoftDeletes;
	protected $table = 'applications';

	protected $fillable = [
		'name',
		'description'
	];

	public function clients()
	{
		return $this->belongsToMany(Client::class)
					->withPivot('id', 'configuration')
					->withTimestamps();
	}
}
