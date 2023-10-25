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
        Schema::create('author_department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id')->index('author_department_author_id_foreign');
            $table->unsignedBigInteger('department_id')->index('author_department_department_id_foreign');
            $table->timestamp('sr_integrated')->nullable();
            $table->timestamps();
            $table->string('rsdk_reporting_group', 255)->nullable();
            $table->string('rsdk_username', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_department');
    }
};
