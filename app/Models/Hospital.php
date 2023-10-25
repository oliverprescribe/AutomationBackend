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
 * Class Hospital
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Client[] $clients
 *
 * @package App\Models
 */
class Hospital extends Model
{
	use SoftDeletes;
	protected $table = 'hospitals';

	protected $fillable = [
		'name'
	];

	public function clients()
	{
		return $this->hasMany(Client::class);
	}
}
