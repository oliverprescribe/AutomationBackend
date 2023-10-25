<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dashboard
 * 
 * @property int $id
 * @property string $client_id
 * @property string $typing
 * @property string $total_typing
 * @property string $editor
 * @property string $total_editor
 * @property string $qa
 * @property string $total_qa
 * @property string $ph_uploaded
 * @property string $total_ph_uploaded
 * @property string $ph_linecount
 * @property string $total_ph_linecount
 * @property string $uk_uploaded
 * @property string $total_uk_uploaded
 * @property string $uk_linecount
 * @property string $total_uk_linecount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Dashboard extends Model
{
	protected $table = 'dashboards';

	protected $fillable = [
		'client_id',
		'typing',
		'total_typing',
		'editor',
		'total_editor',
		'qa',
		'total_qa',
		'ph_uploaded',
		'total_ph_uploaded',
		'ph_linecount',
		'total_ph_linecount',
		'uk_uploaded',
		'total_uk_uploaded',
		'uk_linecount',
		'total_uk_linecount'
	];
}
