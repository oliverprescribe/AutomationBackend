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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id', 255);
            $table->string('typing', 255);
            $table->string('total_typing', 255);
            $table->string('editor', 255);
            $table->string('total_editor', 255);
            $table->string('qa', 255);
            $table->string('total_qa', 255);
            $table->string('ph_uploaded', 255);
            $table->string('total_ph_uploaded', 255);
            $table->string('ph_linecount', 255);
            $table->string('total_ph_linecount', 255);
            $table->string('uk_uploaded', 255);
            $table->string('total_uk_uploaded', 255);
            $table->string('uk_linecount', 255);
            $table->string('total_uk_linecount', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboards');
    }
};
