<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Uploader
 * 
 * @property int $id
 * @property int $letter_id
 * @property int $user_id
 * @property string|null $meddocs_id
 * @property string|null $status
 * @property Carbon|null $date_uploaded
 * @property string|null $remarks
 * @property bool $otpm
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Letter $letter
 * @property User $user
 *
 * @package App\Models
 */
class Uploader extends Model
{
	protected $table = 'uploaders';

	protected $casts = [
		'letter_id' => 'int',
		'user_id' => 'int',
		'date_uploaded' => 'datetime',
		'otpm' => 'bool'
	];

	protected $fillable = [
		'letter_id',
		'user_id',
		'meddocs_id',
		'status',
		'date_uploaded',
		'remarks',
		'otpm'
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
