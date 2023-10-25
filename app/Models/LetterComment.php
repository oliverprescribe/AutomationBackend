<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LetterComment
 * 
 * @property int $id
 * @property int $user_id
 * @property int $letter_id
 * @property string $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $pinned
 * 
 * @property Letter $letter
 * @property User $user
 *
 * @package App\Models
 */
class LetterComment extends Model
{
	protected $table = 'letter_comments';

	protected $casts = [
		'user_id' => 'int',
		'letter_id' => 'int',
		'pinned' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'letter_id',
		'comments',
		'pinned'
	];

	public function letter()
	{
		return $this->belongsTo(Letter::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
