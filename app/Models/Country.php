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
 * Class Country
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $timezone
 * 
 * @property Collection|Client[] $clients
 * @property Collection|Holiday[] $holidays
 *
 * @package App\Models
 */
class Country extends Model
{
	use SoftDeletes;
	protected $table = 'countries';

	protected $fillable = [
		'code',
		'name',
		'timezone'
	];

	public function clients()
	{
		return $this->hasMany(Client::class);
	}

	public function holidays()
	{
		return $this->hasMany(Holiday::class);
	}
}
