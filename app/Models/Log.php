<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * 
 * @property int $id
 * @property string $type
 * @property int|null $letter_id
 * @property string|null $description
 * @property int $loggable_id
 * @property string $loggable_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Log extends Model
{
	protected $table = 'logs';

	protected $casts = [
		'letter_id' => 'int',
		'loggable_id' => 'int'
	];

	protected $fillable = [
		'type',
		'letter_id',
		'description',
		'loggable_id',
		'loggable_type'
	];
}
