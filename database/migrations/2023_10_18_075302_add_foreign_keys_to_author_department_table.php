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
        Schema::table('author_department', function (Blueprint $table) {
            $table->foreign(['author_id'])->references(['id'])->on('authors')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('author_department', function (Blueprint $table) {
            $table->dropForeign('author_department_author_id_foreign');
            $table->dropForeign('author_department_department_id_foreign');
        });
    }
};
