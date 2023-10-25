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
        Schema::create('qmf_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('letter_id');
            $table->unsignedBigInteger('qmf_sub_criteria_id');
            $table->double('no_error', 8, 2);
            $table->double('total_error', 8, 2);
            $table->string('user_type', 255);
            $table->string('status', 255)->default('SAVED');
            $table->string('remarks', 255)->nullable();
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
        Schema::dropIfExists('qmf_audits');
    }
};
