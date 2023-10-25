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
        Schema::create('uploaders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('letter_id')->index('uploaders_letter_id_foreign');
            $table->unsignedBigInteger('user_id')->index('uploaders_user_id_foreign');
            $table->string('meddocs_id', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->timestamp('date_uploaded')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('otpm')->default(false);
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
        Schema::dropIfExists('uploaders');
    }
};
