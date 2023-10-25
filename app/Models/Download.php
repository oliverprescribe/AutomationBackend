<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Download
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $filename
 * @property string|null $path
 * @property string|null $status
 * @property string|null $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Download extends Model
{
	protected $table = 'downloads';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'filename',
		'path',
		'status',
		'type'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
