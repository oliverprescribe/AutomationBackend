<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Letter
 *
 * @property int $id
 * @property int $client_id
 * @property int $department_id
 * @property int $author_id
 * @property int|null $audio_id
 * @property string|null $organization
 * @property Carbon $author_created
 * @property string $status
 * @property int|null $tat
 * @property string $priority
 * @property string|null $reference
 * @property string|null $comments
 * @property int|null $letter_count
 * @property float|null $char_count
 * @property float|null $line_count
 * @property string|null $edited_by
 * @property string|null $letter_content
 * @property string|null $letter_version
 * @property string|null $subject_name
 * @property string|null $subject_id
 * @property string|null $job_type
 * @property string|null $job_type_description
 * @property string|null $user_field1
 * @property string|null $user_field2
 * @property string|null $user_field3
 * @property string|null $user_field4
 * @property string|null $user_field5
 * @property string|null $user_field6
 * @property string|null $user_field7
 * @property string|null $user_field8
 * @property string|null $user_field9
 * @property string|null $user_field10
 * @property string|null $job_notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $location_name
 * @property string|null $job_number
 * @property Carbon|null $date_return
 * @property Carbon|null $v10_upload_error
 * @property Carbon|null $vr_processed
 * @property string|null $vr_provider
 * @property Carbon|null $vr_upload_error
 * @property string|null $vr_accuracy
 * @property string|null $remarks
 * @property int|null $original_letter_count
 * @property float|null $original_char_count
 * @property float|null $original_line_count
 * @property bool $is_qass
 * @property int|null $accuracy
 * @property int|null $total_errors
 * @property string|null $audit_remarks
 * @property Carbon|null $audit_done
 * @property bool $encrypted
 * @property Carbon|null $vr_adaptation
 * @property string|null $vr_adaptation_user
 * @property string|null $vr_adaptation_path
 * @property Carbon|null $vr_adhoc
 * @property Carbon|null $vr_adhoc_done
 * @property string|null $vr_uniqid
 * @property float|null $vr_recognized_char
 * @property float|null $vr_adaptation_char
 * @property bool $is_auditqa
 * @property Carbon|null $date_completed
 * @property string|null $v10_remarks
 * @property int|null $v10_author_id
 * @property float|null $line_count_deducted
 *
 * @property Author $author
 * @property Client $client
 * @property Department $department
 * @property Collection|Assignment[] $assignments
 * @property Collection|Audio[] $audio
 * @property Collection|LetterComment[] $letter_comments
 * @property Collection|Uploader[] $uploaders
 *
 * @package App\Models
 */
class Letter extends Model
{
	protected $table = 'letters';

	protected $casts = [
		'client_id' => 'int',
		'department_id' => 'int',
		'author_id' => 'int',
		'audio_id' => 'int',
		'author_created' => 'datetime',
		'tat' => 'int',
		'letter_count' => 'int',
		'char_count' => 'float',
		'line_count' => 'float',
		'date_return' => 'datetime',
		'v10_upload_error' => 'datetime',
		'vr_processed' => 'datetime',
		'vr_upload_error' => 'datetime',
		'original_letter_count' => 'int',
		'original_char_count' => 'float',
		'original_line_count' => 'float',
		'is_qass' => 'bool',
		'accuracy' => 'int',
		'total_errors' => 'int',
		'audit_done' => 'datetime',
		'encrypted' => 'bool',
		'vr_adaptation' => 'datetime',
		'vr_adhoc' => 'datetime',
		'vr_adhoc_done' => 'datetime',
		'vr_recognized_char' => 'float',
		'vr_adaptation_char' => 'float',
		'is_auditqa' => 'bool',
		'date_completed' => 'datetime',
		'v10_author_id' => 'int',
		'line_count_deducted' => 'float'
	];

	protected $fillable = [
		'client_id',
		'department_id',
		'author_id',
		'audio_id',
		'organization',
		'author_created',
		'status',
		'tat',
		'priority',
		'reference',
		'comments',
		'letter_count',
		'char_count',
		'line_count',
		'edited_by',
		'letter_content',
		'letter_version',
		'subject_name',
		'subject_id',
		'job_type',
		'job_type_description',
		'user_field1',
		'user_field2',
		'user_field3',
		'user_field4',
		'user_field5',
		'user_field6',
		'user_field7',
		'user_field8',
		'user_field9',
		'user_field10',
		'job_notes',
		'location_name',
		'job_number',
		'date_return',
		'v10_upload_error',
		'vr_processed',
		'vr_provider',
		'vr_upload_error',
		'vr_accuracy',
		'remarks',
		'original_letter_count',
		'original_char_count',
		'original_line_count',
		'is_qass',
		'accuracy',
		'total_errors',
		'audit_remarks',
		'audit_done',
		'encrypted',
		'vr_adaptation',
		'vr_adaptation_user',
		'vr_adaptation_path',
		'vr_adhoc',
		'vr_adhoc_done',
		'vr_uniqid',
		'vr_recognized_char',
		'vr_adaptation_char',
		'is_auditqa',
		'date_completed',
		'v10_remarks',
		'v10_author_id',
		'line_count_deducted'
	];

	public function author()
	{
		return $this->belongsTo(Author::class);
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function assignments()
	{
		return $this->hasMany(Assignment::class);
	}

	public function audio()
	{
		return $this->hasMany(Audio::class);
	}

	public function letter_comments()
	{
		return $this->hasMany(LetterComment::class);
	}

	public function uploaders()
	{
		return $this->hasMany(Uploader::class);
	}
}
