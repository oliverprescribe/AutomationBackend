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
        Schema::create('letter_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('letter_id');
            $table->integer('letter_count')->nullable();
            $table->double('char_count')->nullable();
            $table->double('line_count')->nullable();
            $table->string('path', 255);
            $table->integer('version')->default(1);
            $table->timestamps();
            $table->string('sd_path', 255)->nullable();
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
        Schema::dropIfExists('letter_versions');
    }
};
