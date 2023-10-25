<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QmfCriteria
 * 
 * @property int $id
 * @property int $qmf_id
 * @property string $name
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QmfCriteria extends Model
{
	protected $table = 'qmf_criterias';

	protected $casts = [
		'qmf_id' => 'int',
		'sort_order' => 'int'
	];

	protected $fillable = [
		'qmf_id',
		'name',
		'sort_order'
	];
}
