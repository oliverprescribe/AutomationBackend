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
        Schema::create('qmf_sub_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('qmf_criteria_id');
            $table->string('name', 255);
            $table->double('rating', 8, 2);
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
        Schema::dropIfExists('qmf_sub_criterias');
    }
};
