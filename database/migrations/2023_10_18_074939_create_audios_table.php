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
        Schema::create('audios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('letter_id')->index('audios_letter_id_foreign');
            $table->string('filename', 255)->nullable();
            $table->integer('minutes')->default(0);
            $table->integer('seconds')->default(0);
            $table->string('filesize', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->string('converted_path', 255)->nullable();
            $table->timestamps();
            $table->string('disk', 255)->default('local');
            $table->boolean('is_vol_good')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audios');
    }
};
