<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Assignment
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int $letter_id
 * @property string $user_type
 * @property string|null $send_to
 * @property Carbon|null $started
 * @property Carbon|null $ended
 * @property int|null $letter_count
 * @property float|null $char_count
 * @property float|null $line_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $letter_version_id
 * @property float|null $accuracy
 * @property int|null $total_errors
 * @property string|null $audited_file_id
 * @property string|null $audited_content
 * @property float|null $line_count_deducted
 * 
 * @property Letter $letter
 * @property User|null $user
 *
 * @package App\Models
 */
class Assignment extends Model
{
	protected $table = 'assignments';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'started' => 'datetime',
		'ended' => 'datetime',
		'letter_count' => 'int',
		'char_count' => 'float',
		'line_count' => 'float',
		'letter_version_id' => 'int',
		'accuracy' => 'float',
		'total_errors' => 'int',
		'line_count_deducted' => 'float'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'user_type',
		'send_to',
		'started',
		'ended',
		'letter_count',
		'char_count',
		'line_count',
		'letter_version_id',
		'accuracy',
		'total_errors',
		'audited_file_id',
		'audited_content',
		'line_count_deducted'
	];

	public function letter()
	{
		return $this->belongsTo(Letter::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
