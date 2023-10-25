<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QmfAudit
 * 
 * @property int $id
 * @property int $user_id
 * @property int $letter_id
 * @property int $qmf_sub_criteria_id
 * @property float $no_error
 * @property float $total_error
 * @property string $user_type
 * @property string $status
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QmfAudit extends Model
{
	protected $table = 'qmf_audits';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'qmf_sub_criteria_id' => 'int',
		'no_error' => 'float',
		'total_error' => 'float'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'qmf_sub_criteria_id',
		'no_error',
		'total_error',
		'user_type',
		'status',
		'remarks'
	];
}
