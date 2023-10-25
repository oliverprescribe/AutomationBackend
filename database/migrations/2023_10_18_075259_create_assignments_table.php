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
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index('assignments_user_id_foreign');
            $table->unsignedBigInteger('letter_id')->index('assignments_letter_id_foreign');
            $table->string('user_type', 255);
            $table->string('send_to', 255)->nullable();
            $table->timestamp('started')->nullable();
            $table->timestamp('ended')->nullable();
            $table->integer('letter_count')->nullable();
            $table->double('char_count')->nullable();
            $table->double('line_count')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('letter_version_id')->nullable();
            $table->double('accuracy')->nullable();
            $table->integer('total_errors')->nullable();
            $table->string('audited_file_id', 255)->nullable();
            $table->longText('audited_content')->nullable();
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
        Schema::dropIfExists('assignments');
    }
};
