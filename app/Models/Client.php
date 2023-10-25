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
 * Class Client
 * 
 * @property int $id
 * @property int $country_id
 * @property int $hospital_id
 * @property string $contract_code
 * @property string $name
 * @property string $abbreviation
 * @property string|null $description
 * @property int $linecount_divisor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $api_token
 * @property string|null $client_api_token
 * 
 * @property Country $country
 * @property Hospital $hospital
 * @property Collection|Application[] $applications
 * @property Collection|Author[] $authors
 * @property Collection|Department[] $departments
 * @property Collection|Letter[] $letters
 *
 * @package App\Models
 */
class Client extends Model
{
	use SoftDeletes;
	protected $table = 'clients';

	protected $casts = [
		'country_id' => 'int',
		'hospital_id' => 'int',
		'linecount_divisor' => 'int'
	];

	protected $hidden = [
		'api_token',
		'client_api_token'
	];

	protected $fillable = [
		'country_id',
		'hospital_id',
		'contract_code',
		'name',
		'abbreviation',
		'description',
		'linecount_divisor',
		'api_token',
		'client_api_token'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function hospital()
	{
		return $this->belongsTo(Hospital::class);
	}

	public function applications()
	{
		return $this->belongsToMany(Application::class)
					->withPivot('id', 'configuration')
					->withTimestamps();
	}

	public function authors()
	{
		return $this->hasMany(Author::class);
	}

	public function departments()
	{
		return $this->hasMany(Department::class);
	}

	public function letters()
	{
		return $this->hasMany(Letter::class);
	}
}
