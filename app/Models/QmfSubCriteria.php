<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QmfSubCriteria
 * 
 * @property int $id
 * @property int $qmf_criteria_id
 * @property string $name
 * @property float $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QmfSubCriteria extends Model
{
	protected $table = 'qmf_sub_criterias';

	protected $casts = [
		'qmf_criteria_id' => 'int',
		'rating' => 'float'
	];

	protected $fillable = [
		'qmf_criteria_id',
		'name',
		'rating'
	];
}
