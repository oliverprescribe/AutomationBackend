<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('letters_client_id_foreign');
            $table->unsignedBigInteger('department_id')->index('letters_department_id_foreign');
            $table->unsignedBigInteger('author_id')->index('letters_author_id_foreign');
            $table->unsignedBigInteger('audio_id')->nullable();
            $table->string('organization', 255)->nullable();
            $table->dateTime('author_created');
            $table->string('status', 255)->default('received');
            $table->integer('tat')->nullable();
            $table->string('priority', 255);
            $table->string('reference', 255)->nullable();
            $table->text('comments')->nullable();
            $table->integer('letter_count')->nullable();
            $table->double('char_count')->nullable();
            $table->double('line_count')->nullable();
            $table->string('edited_by', 255)->nullable();
            $table->longText('letter_content')->nullable();
            $table->string('letter_version', 255)->nullable();
            $table->string('subject_name', 255)->nullable();
            $table->string('subject_id', 255)->nullable();
            $table->string('job_type', 255)->nullable();
            $table->string('job_type_description', 255)->nullable();
            $table->string('user_field1', 255)->nullable();
            $table->string('user_field2', 255)->nullable();
            $table->string('user_field3', 255)->nullable();
            $table->string('user_field4', 255)->nullable();
            $table->string('user_field5', 255)->nullable();
            $table->string('user_field6', 255)->nullable();
            $table->string('user_field7', 255)->nullable();
            $table->string('user_field8', 255)->nullable();
            $table->string('user_field9', 255)->nullable();
            $table->string('user_field10', 255)->nullable();
            $table->longText('job_notes')->nullable();
            $table->timestamps();
            $table->string('location_name', 255)->nullable();
            $table->string('job_number', 255)->nullable();
            $table->dateTime('date_return')->nullable();
            $table->dateTime('v10_upload_error')->nullable();
            $table->dateTime('vr_processed')->nullable();
            $table->string('vr_provider', 255)->nullable();
            $table->dateTime('vr_upload_error')->nullable();
            $table->string('vr_accuracy', 255)->nullable();
            $table->string('remarks', 255)->nullable();
            $table->integer('original_letter_count')->nullable();
            $table->double('original_char_count')->nullable();
            $table->double('original_line_count')->nullable();
            $table->boolean('is_qass')->default(false);
            $table->integer('accuracy')->nullable();
            $table->integer('total_errors')->nullable();
            $table->longText('audit_remarks')->nullable();
            $table->timestamp('audit_done')->nullable();
            $table->boolean('encrypted')->default(false);
            $table->timestamp('vr_adaptation')->nullable();
            $table->string('vr_adaptation_user', 255)->nullable();
            $table->string('vr_adaptation_path', 255)->nullable();
            $table->dateTime('vr_adhoc')->nullable();
            $table->dateTime('vr_adhoc_done')->nullable();
            $table->string('vr_uniqid', 255)->nullable();
            $table->double('vr_recognized_char')->nullable();
            $table->double('vr_adaptation_char')->nullable();
            $table->boolean('is_auditqa')->default(false);
            $table->timestamp('date_completed')->nullable();
            $table->text('v10_remarks')->nullable();
            $table->unsignedBigInteger('v10_author_id')->nullable();
            $table->double('line_count_deducted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters');
    }
};
