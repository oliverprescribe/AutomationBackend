<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QmfAuditFile
 * 
 * @property int $id
 * @property int $user_id
 * @property int $letter_id
 * @property int|null $letter_count
 * @property float|null $char_count
 * @property float|null $line_count
 * @property string $path
 * @property int $version
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QmfAuditFile extends Model
{
	protected $table = 'qmf_audit_files';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'letter_count' => 'int',
		'char_count' => 'float',
		'line_count' => 'float',
		'version' => 'int'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'letter_count',
		'char_count',
		'line_count',
		'path',
		'version'
	];
}
