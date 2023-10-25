<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeTracker
 * 
 * @property int $id
 * @property int $user_id
 * @property int|null $letter_id
 * @property string $type
 * @property Carbon $in
 * @property Carbon|null $out
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $letter_version_id
 *
 * @package App\Models
 */
class TimeTracker extends Model
{
	protected $table = 'time_trackers';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'in' => 'datetime',
		'out' => 'datetime',
		'letter_version_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'type',
		'in',
		'out',
		'remarks',
		'letter_version_id'
	];
}
