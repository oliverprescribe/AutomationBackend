<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorRating
 * 
 * @property int $id
 * @property int $user_id
 * @property int $rating_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class AuthorRating extends Model
{
	protected $table = 'author_ratings';

	protected $casts = [
		'user_id' => 'int',
		'rating_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'rating_id'
	];
}
