<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationClient
 * 
 * @property int $id
 * @property int $application_id
 * @property int $client_id
 * @property string $configuration
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Application $application
 * @property Client $client
 *
 * @package App\Models
 */
class ApplicationClient extends Model
{
	protected $table = 'application_client';

	protected $casts = [
		'application_id' => 'int',
		'client_id' => 'int'
	];

	protected $fillable = [
		'application_id',
		'client_id',
		'configuration'
	];

	public function application()
	{
		return $this->belongsTo(Application::class);
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}
}
