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
        Schema::table('application_client', function (Blueprint $table) {
            $table->foreign(['application_id'])->references(['id'])->on('applications')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_client', function (Blueprint $table) {
            $table->dropForeign('application_client_application_id_foreign');
            $table->dropForeign('application_client_client_id_foreign');
        });
    }
};
