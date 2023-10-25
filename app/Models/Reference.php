<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reference
 * 
 * @property int $id
 * @property string $client_id
 * @property string $department_id
 * @property string $author_id
 * @property string $tag
 * @property string $filename
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $v10_letter_id
 *
 * @package App\Models
 */
class Reference extends Model
{
	protected $table = 'references';

	protected $fillable = [
		'client_id',
		'department_id',
		'author_id',
		'tag',
		'filename',
		'path',
		'v10_letter_id'
	];
}
