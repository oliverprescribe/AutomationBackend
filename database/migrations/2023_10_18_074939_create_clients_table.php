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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->index('clients_country_id_foreign');
            $table->unsignedBigInteger('hospital_id')->index('clients_hospital_id_foreign');
            $table->string('contract_code', 255)->unique();
            $table->string('name', 255);
            $table->string('abbreviation', 255);
            $table->string('description', 255)->nullable();
            $table->integer('linecount_divisor');
            $table->timestamps();
            $table->softDeletes();
            $table->text('api_token')->nullable();
            $table->text('client_api_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
