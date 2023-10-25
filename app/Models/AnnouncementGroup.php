<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnouncementGroup
 * 
 * @property int $id
 * @property int $group_id
 * @property int $announcement_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Announcement $announcement
 * @property Group $group
 *
 * @package App\Models
 */
class AnnouncementGroup extends Model
{
	protected $table = 'announcement_groups';

	protected $casts = [
		'group_id' => 'int',
		'announcement_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'announcement_id'
	];

	public function announcement()
	{
		return $this->belongsTo(Announcement::class);
	}

	public function group()
	{
		return $this->belongsTo(Group::class);
	}
}
