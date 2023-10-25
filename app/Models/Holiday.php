<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Holiday
 * 
 * @property int $id
 * @property int $country_id
 * @property string $holiday_name
 * @property Carbon $holiday_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Country $country
 *
 * @package App\Models
 */
class Holiday extends Model
{
	use SoftDeletes;
	protected $table = 'holidays';

	protected $casts = [
		'country_id' => 'int',
		'holiday_date' => 'datetime'
	];

	protected $fillable = [
		'country_id',
		'holiday_name',
		'holiday_date'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
