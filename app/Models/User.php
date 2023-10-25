<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasFactory, Notifiable, HasApiTokens;
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'organization_id' => 'int',
		'adaptation' => 'bool',
		'vendor_organizations_id' => 'int',
		'is_vendor' => 'bool'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'first_name',
		'middle_name',
		'last_name',
		'suffix',
		'user_code',
		'position',
		'job_limit',
		'user_level',
		'organization_id',
		'adaptation',
		'username',
		'vendor_organizations_id',
		'is_vendor',
		'preferences'
	];

	public function announcements()
	{
		return $this->belongsToMany(Announcement::class, 'announcement_users')
					->withPivot('id', 'is_acknowledged', 'read_at')
					->withTimestamps();
	}

	public function assignments()
	{
		return $this->hasMany(Assignment::class);
	}

	public function downloads()
	{
		return $this->hasMany(Download::class);
	}

	public function groups()
	{
		return $this->belongsToMany(Group::class)
					->withPivot('id', 'suspended_start', 'suspended_end')
					->withTimestamps();
	}

	public function letter_comments()
	{
		return $this->hasMany(LetterComment::class);
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}

	public function uploaders()
	{
		return $this->hasMany(Uploader::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'user_permission')
					->withPivot('id')
					->withTimestamps();
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_role')
					->withPivot('id')
					->withTimestamps();
	}
}
