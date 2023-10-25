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
        Schema::table('letter_comments', function (Blueprint $table) {
            $table->foreign(['letter_id'])->references(['id'])->on('letters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('letter_comments', function (Blueprint $table) {
            $table->dropForeign('letter_comments_letter_id_foreign');
            $table->dropForeign('letter_comments_user_id_foreign');
        });
    }
};
