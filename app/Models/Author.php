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
 * Class Author
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $code
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $speaker_difficulty
 * @property string|null $to_typist
 * @property string|null $to_qa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $v10_user_token
 *
 * @property Client $client
 * @property Collection|Department[] $departments
 * @property Collection|Letter[] $letters
 *
 * @package App\Models
 */
class Author extends Model
{
	use SoftDeletes;
	protected $table = 'authors';

	// protected $casts = [
	// 	'client_id' => 'int'
	// ];

	// protected $hidden = [
	// 	'v10_user_token'
	// ];

	protected $fillable = [
		'client_id',
		'code',
		'first_name',
		'middle_name',
		'last_name',
		'speaker_difficulty',
		'to_typist',
		'to_qa',
		'v10_user_token'
	];

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function departments()
	{
		return $this->belongsToMany(Department::class)
					->withPivot('id', 'sr_integrated', 'rsdk_reporting_group', 'rsdk_username')
					->withTimestamps();
	}

	public function letters()
	{
		return $this->hasMany(Letter::class);
	}
}
