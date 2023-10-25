<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Audio
 * 
 * @property int $id
 * @property int $letter_id
 * @property string|null $filename
 * @property int $minutes
 * @property int $seconds
 * @property string|null $filesize
 * @property string|null $path
 * @property string|null $converted_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $disk
 * @property bool $is_vol_good
 * 
 * @property Letter $letter
 *
 * @package App\Models
 */
class Audio extends Model
{
	protected $table = 'audios';

	protected $casts = [
		'letter_id' => 'int',
		'minutes' => 'int',
		'seconds' => 'int',
		'is_vol_good' => 'bool'
	];

	protected $fillable = [
		'letter_id',
		'filename',
		'minutes',
		'seconds',
		'filesize',
		'path',
		'converted_path',
		'disk',
		'is_vol_good'
	];

	public function letter()
	{
		return $this->belongsTo(Letter::class);
	}
}
