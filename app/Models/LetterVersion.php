<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LetterVersion
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int $letter_id
 * @property int|null $letter_count
 * @property float|null $char_count
 * @property float|null $line_count
 * @property string $path
 * @property int $version
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $sd_path
 * @property float|null $line_count_deducted
 *
 * @package App\Models
 */
class LetterVersion extends Model
{
	protected $table = 'letter_versions';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'letter_count' => 'int',
		'char_count' => 'float',
		'line_count' => 'float',
		'version' => 'int',
		'line_count_deducted' => 'float'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'letter_count',
		'char_count',
		'line_count',
		'path',
		'version',
		'sd_path',
		'line_count_deducted'
	];
}
